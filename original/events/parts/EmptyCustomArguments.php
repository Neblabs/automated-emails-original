<?php

namespace AutomatedEmails\Original\Events\Parts;

use AutomatedEmails\Original\Events\Wordpress\EventArguments;

use function AutomatedEmails\Original\Utilities\Collection\_;

Trait EmptyCustomArguments
{
    public function createEventArguments() : EventArguments
    {
        return new EventArguments(_(
            //
        ));
    }
}