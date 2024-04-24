<?php

namespace AutomatedEmails\Original\Events\Wordpress\Exceptions;

use AutomatedEmails\Original\Events\Wordpress\Abilities\ExceptionHandler;
use Throwable;

class UnhandledExceptionHandler implements ExceptionHandler
{
    public function handle(Throwable $exception): mixed
    {
        throw $exception;
    } 
}