<?php

namespace AutomatedEmails\Original\Events;

use AutomatedEmails\Original\Events\Wordpress\EventHandler;

interface SubscriberRequiresEventHandler
{
    public function setEventHandler(EventHandler $eventHandler);
}