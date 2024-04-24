<?php

namespace AutomatedEmails\App\Subscribers;

use AutomatedEmails\Original\Events\Parts\DefaultPriority;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\Wordpress\EventArguments;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;

use function AutomatedEmails\Original\Utilities\Collection\_;

Class DashboardBaseElementRenderer implements Subscriber
{
    use DefaultPriority;

    public function createEventArguments() : EventArguments
    {
        return new EventArguments(_(
            //
        ));
    }

    public function validator() : Validator
    {
        return new PassingValidator;
    }

    public function execute() : void
    {
        print '<div id="automated-emails-dashboard"></div>';
    }
} 