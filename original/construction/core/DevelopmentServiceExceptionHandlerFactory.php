<?php

namespace AutomatedEmails\Original\Construction\Core;

use AutomatedEmails\Original\Construction\Abilities\HandleableServiceExceptionFactory;
use AutomatedEmails\Original\Construction\Abilities\OverloadableFactory;
use AutomatedEmails\Original\Core\Abilities\HandleableServiceException;
use AutomatedEmails\Original\Core\Exceptions\Handlers\UnhandledServiceExceptionHandler;
use AutomatedEmails\Original\Environment\Abilities\Environment;

class DevelopmentServiceExceptionHandlerFactory implements 
    OverloadableFactory,
    HandleableServiceExceptionFactory
{
    /** @param Environment $value */
    public function canCreate(mixed $value): bool
    {
        return $value->isDevelopment() || $value->isTesting() || error_reporting();
    } 

    public function create(): HandleableServiceException
    {
        return new UnhandledServiceExceptionHandler;       
    } 
}