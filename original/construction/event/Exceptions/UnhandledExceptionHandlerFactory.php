<?php

namespace AutomatedEmails\Original\Construction\Event\Exceptions;

use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\Wordpress\Abilities\ExceptionHandler;
use AutomatedEmails\Original\Events\Wordpress\Abilities\ManuallyHandleExceptions;
use AutomatedEmails\Original\Events\Wordpress\Exceptions\UnhandledExceptionHandler;

class UnhandledExceptionHandlerFactory extends ExceptionHandlerFactory
{
    public function create(Subscriber|ManuallyHandleExceptions $subscriber) : ExceptionHandler
    {
        return new UnhandledExceptionHandler;
    }
}