<?php

namespace AutomatedEmails\Original\Core;

use AutomatedEmails\Original\Core\Abilities\HandleableServiceException;
use AutomatedEmails\Original\Core\Abilities\Service;
use AutomatedEmails\Original\Core\Abilities\ServicesContainer;

use Throwable;

class Application implements ServicesContainer
{
    public function __construct(
        protected HandleableServiceException $serviceExceptionHandler,
        protected Services $queuedServices = new Services,
        protected Services $runningServices = new Services,
    ) {}
    
    public function start() : void
    {
        /**
         * todo: maybe add a maximum call stack limit to prevent the server from hanging 
         * on infinite circular references.
         * 
         * We have a while loop because we want to give services the chance 
         * to register extra services on start.
         */
        
        while ($this->queuedServices->haveAny()) {
            $this->queuedServices->start($this);
        }
    }

    public function stop() : void
    {
        $this->runningServices->stop($this);
    }

    public function onServiceStart(Service $service) : void
    {
        $this->runningServices->add($service);
        $this->queuedServices->remove($service);
    }

    public function onServiceStop(Service $service): void
    {
        $this->queuedServices->prepend($service);
        $this->runningServices->remove($service);
    } 

    public function onServiceException(Service $service, Throwable $exception) : void
    {
        //throw $exception;
        //todo: add a failing services  instance so that other services can pick them up
        $this->queuedServices->remove($service);
        $this->serviceExceptionHandler->handle(exception: $exception, service: $service);
    }

    public function addService(Service $service) : void
    {
        $this->queuedServices->add($service);
    }

    public function runningServices() : Services
    {
        return $this->runningServices;
    }

    public function queuedServices() : Services
    {
        return $this->queuedServices;
    }

    /**
     * In a future we'll store the services that failed here
     *  so that another service might log this info depending on the context, for example:
     *
     *  in production: we might have a logger that logs this in a database for the user to inspect
     *  or another that shows it in an admin notification
     *  or another that sends an email (there are many possibilities), 
     *  instead of the plugin failing in a fatal error without any feedback.
     *
    public function failedServices() : Services
    {
        return $this->failedServices;
    }
    */
}