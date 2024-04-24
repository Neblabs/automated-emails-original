<?php

namespace AutomatedEmails\Original\Subscribers;

use AutomatedEmails\Original\Core\Abilities\ServicesContainer;
use AutomatedEmails\Original\Core\Application;
use AutomatedEmails\Original\Events\Parts\DefaultPriority;
use AutomatedEmails\Original\Events\Parts\EmptyCustomArguments;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\Wordpress\EventArguments;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;

use function AutomatedEmails\Original\Utilities\Collection\_;

Class ServicesRestarter implements Subscriber
{
    use DefaultPriority, EmptyCustomArguments;

    public function __construct(
        protected Application $application
    ) {}
    
    public function validator() : Validator
    {
        (boolean) $itsTheSecondTimeInitHasBeenCalled = did_action('init') > 1;

        return new ValidWhen($itsTheSecondTimeInitHasBeenCalled);
    }

    public function execute() : void
    {
        $this->application->stop();

        $this->application->start();
    }
} 

