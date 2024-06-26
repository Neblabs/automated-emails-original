<?php

namespace AutomatedEmails\Original\Events\Wordpress;

use AutomatedEmails\App\Creation\Validators\SubscriberValidatorFactory;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Event\Exceptions\ExceptionHandlerFactory;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\SubscriberRequiresEventHandler;
use AutomatedEmails\Original\Events\Wordpress\EventArguments;
use Exception;
use ReflectionMethod;
use ReflectionParameter;
use Throwable;

Class EventHandler
{
    private EventArguments $eventArguments;

    public function __construct(
        protected Subscriber $subscriber,
        protected ExceptionHandlerFactory $exceptionHandlerFactory,
        SubscriberValidatorFactory $subscriberValidatorFactory = new SubscriberValidatorFactory('development')
    ) {
        $subscriberValidatorFactory->create($this->subscriber)->validate();

        $this->setCurrentInstanceIfItRequiresIt();
    }
    
    public function handle(...$originalArguments) : mixed
    {
        try {
            return $this->handleEvent(...$originalArguments);
        } catch (Throwable $exception) {
            return $this->handleException($exception);
        }
    }

    protected function handleEvent(...$originalArguments)
    {
        $this->setEventArguments($originalArguments);

        if ($this->subscriberCanBeExecuted()) {
            return $this->subscriber->execute(...$this->requestedArgumentsFor('execute'));
        }
    }

    protected function handleException(Throwable $exception) : mixed
    {
        (object) $exceptionHandler = $this->exceptionHandlerFactory->create($this->subscriber);

        return $exceptionHandler->handle($exception);
    }
    
    
    public function requestedArgumentsFor(string $method) : array
    {
        (object) $reflectionMethod = new ReflectionMethod($this->subscriber, $method);
        (object) $methodParameters = new Collection($reflectionMethod->getParameters());

        return $methodParameters->map(function(ReflectionParameter $reflectionParameter) : mixed {
            (string) $name = $reflectionParameter->getName();
            //dump($this->eventArguments);
            if (!$this->eventArguments->hasKey($name)) {
                throw new Exception("Event does not have the requested argument: {$name}");
            }

            return $this->eventArguments->get($name);
        })->asArray();
    }

    protected function setEventArguments(array $originalArguments) : void
    {
        $this->eventArguments = $this->subscriber->createEventArguments(...$originalArguments);
    }    

    protected function subscriberCanBeExecuted() : bool
    {
        (array) $requestedArguments = $this->requestedArgumentsFor('validator');

        return $this->subscriber->validator(...$requestedArguments)->isValid();
    }

    protected function setCurrentInstanceIfItRequiresIt() : void
    {
        if ($this->subscriber instanceof SubscriberRequiresEventHandler) {
            $this->subscriber->setEventHandler($this);
        }
    }
 }