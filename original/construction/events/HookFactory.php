<?php

namespace AutomatedEmails\Original\Construction\Events;

use AutomatedEmails\Original\Events\Wordpress\Action;
use AutomatedEmails\Original\Events\Wordpress\Filter;
use AutomatedEmails\Original\Events\Wordpress\Hook;
use AutomatedEmails\Original\Events\Wordpress\Request;

Class HookFactory 
{
    public function createFromRequest(Request\Hook $hookRequest) : Hook
    {
        (string) $name = $hookRequest->name();

        return match($hookRequest->type()) {
            Action::class => new Action($name),
            Filter::class => new Filter($name)
        };
    }
}