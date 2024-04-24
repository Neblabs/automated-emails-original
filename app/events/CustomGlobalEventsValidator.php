<?php

namespace AutomatedEmails\App\Events;

use AutomatedEmails\Original\Cache\MemoryCache;
use AutomatedEmails\Original\Events\Handler\GlobalEventsValidator;

Class CustomGlobalEventsValidator extends GlobalEventsValidator
{
    protected static $messageHasBeenRegistered = false;

    public function canBeExecuted() : bool
    {
        return true;       
    }
}