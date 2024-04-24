<?php

namespace AutomatedEmails\Original\Subscribers;

use AutomatedEmails\Original\Events\Parts\DefaultPriority;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\Wordpress\EventArguments;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;

use function AutomatedEmails\Original\Utilities\Collection\_;

Class Greeter implements Subscriber
{
    use DefaultPriority;

    public function createEventArguments() : EventArguments
    {
        return new EventArguments(_(
            name: 'Rafa'
        ));
    }

    public function validator() : Validator
    {
        return new PassingValidator;
    }

    public function execute(string $name) : void
    {
        //exit("Hello, {$name}!");
    }
} 

