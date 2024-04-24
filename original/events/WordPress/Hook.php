<?php

namespace AutomatedEmails\Original\Events\Wordpress;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Events\EventHandlerFactory;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\System\Functions\GlobalFunctionWrapper;
use ReflectionMethod;

use function AutomatedEmails\Original\Utilities\Collection\a;

Abstract Class Hook
{
    protected Collection $subscribers;
    protected Collection $handlers;
    protected EventArguments $eventArguments;

    abstract public function register() : void;
    abstract public function unregister() : void;

    public function __construct(
        protected string $name, 
        protected GlobalFunctionWrapper $globalFunctionWraper = new GlobalFunctionWrapper,
        protected EventHandlerFactory $eventHandlerFactory = new EventHandlerFactory
    )
    {
        $this->subscribers = new Collection([]);
        $this->handlers = new Collection([]);
    }
    
    public function add(Subscriber $subscriber) : void
    {
        $this->subscribers->push($subscriber);
    }

    public function addHandler(callable $handler, int $priority) : void
    {
        $this->handlers->push(a(handler: $handler, priority: $priority));
    }

    public function removeHandler(callable $handlerToRemove) : void
    {
        $this->handlers->filterAndRemove(fn(array $handlerAndPriority) => $handlerAndPriority['handler'] === $handlerToRemove);
    }

    public function addSubscribers(Collection $subscribers) : void
    {
        $subscribers->forEvery(fn(Subscriber $subscriber) => $this->add($subscriber));
    }

    /** 
     * Ideally, this would be a method of Subscriber, but
     * since it's an interface, we'll just implement it here.
     * 
     */
    protected function numberOfAcceptedArgumentsForSubscriber(Subscriber $subscriber) : int
    {
        (object) $reflectionMethod = new ReflectionMethod($subscriber, 'createEventArguments');

        return ($reflectionMethod->getNumberOfParameters());
    }
}