<?php

namespace AutomatedEmails\Original\Exceptions;

use AutomatedEmails\Original\Events\Wordpress\Abilities\ExceptionHandler;
use Throwable;

class UnhandledExceptionHandler implements ExceptionHandler
{
    public function handle(Throwable $exception)
    {
        throw $exception;
    } 
}