<?php

namespace AutomatedEmails\Original\Construction\Event\Exceptions;

use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\Wordpress\Abilities\AutomaticallyHandleExceptions;
use AutomatedEmails\Original\Events\Wordpress\Abilities\ExceptionHandler;
use AutomatedEmails\Original\Events\Wordpress\Abilities\ManuallyHandleExceptions;
use AutomatedEmails\Original\Events\Wordpress\Exceptions\ManualExceptionHandler;
use AutomatedEmails\Original\Events\Wordpress\Exceptions\SilentExceptionHandler;
use AutomatedEmails\Original\Events\Wordpress\Exceptions\UnhandledExceptionHandler;

class ExceptionHandlerFactory
{
    public function create(Subscriber|ManuallyHandleExceptions $subscriber) : ExceptionHandler
    {
        return match(true) {
            $subscriber instanceof AutomaticallyHandleExceptions => new SilentExceptionHandler,
            $subscriber instanceof ManuallyHandleExceptions => new ManualExceptionHandler(
                $subscriber
            ),
            default => new UnhandledExceptionHandler
        };
    }
}