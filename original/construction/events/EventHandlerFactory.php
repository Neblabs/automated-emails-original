<?php

namespace AutomatedEmails\Original\Construction\Events;

use AutomatedEmails\Original\Construction\Event\Exceptions\ExceptionHandlerFactory;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\Wordpress\EventHandler;

Class EventHandlerFactory
{
    public function __construct(
        protected ExceptionHandlerFactory $exceptionHandlerFactory = new ExceptionHandlerFactory
    ) {}

    public function create(Subscriber $subscriber) : Eventhandler
    {
        return new EventHandler(
            $subscriber,
            $this->exceptionHandlerFactory
        );   
    }
}