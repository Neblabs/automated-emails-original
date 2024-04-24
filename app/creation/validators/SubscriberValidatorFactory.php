<?php

namespace AutomatedEmails\App\Creation\Validators;

use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\DuckInterfaceIsImplemented;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;

class SubscriberValidatorFactory
{
    public function __construct(
        private string $environment
    ) {}

    public function create(Subscriber $subscriber) : Validator
    {
        return match($this->environment) {
            'production' =>  new PassingValidator,
            default => new DuckInterfaceIsImplemented(
                interface: Subscriber::class,
                implementation: $subscriber::class
            )
        };
    }
}