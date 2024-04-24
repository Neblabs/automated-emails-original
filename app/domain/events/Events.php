<?php

namespace AutomatedEmails\App\Domain\Events;

use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Events\Subscriber;

Class Events extends Entities
{
    public function registerWith(Subscriber $subscriber) : void
    {
        $this->entities->perform(addSubscriber: $subscriber);
        $this->entities->perform(register: null);
    }

    protected function getDomainClass() : string
    {
        return Event::class;
    }
}