<?php

namespace AutomatedEmails\Original\Events\Wordpress;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Events\EventHandlerFactory;
use AutomatedEmails\Original\Events\Subscriber;
use function AutomatedEmails\Original\Utilities\Collection\_;

class EventsHandler
{
    protected Collection $subscribers;

    public function __construct(
        protected EventHandlerFactory $eventHandlerFactory
    ) {
        $this->subscribers = _();
    }

    public function addSubscriber(Subscriber $subscriber) : void
    {
        $this->subscribers->push($subscriber);
    }

    public function handle(...$originalArguments) : void
    {
        foreach ($this->subscribers as $subscriber) {
            (object) $eventHandler = $this->eventHandlerFactory->create($subscriber);
            
            $eventHandler->handle(...$originalArguments);
        }
    }
}