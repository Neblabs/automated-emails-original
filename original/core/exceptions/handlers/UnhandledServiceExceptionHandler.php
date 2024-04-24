<?php

namespace AutomatedEmails\Original\Core\Exceptions\Handlers;

use AutomatedEmails\Original\Core\Abilities\HandleableServiceException;
use Throwable;
use AutomatedEmails\Original\Core\Abilities\Service;

class UnhandledServiceExceptionHandler implements HandleableServiceException
{
    public function handle(Throwable $exception, Service $service)
    {
        throw $exception;
    } 
}