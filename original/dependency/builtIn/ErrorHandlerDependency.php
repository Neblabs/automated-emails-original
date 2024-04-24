<?php

namespace AutomatedEmails\Original\Dependency\BuiltIn;

use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Error\Abilities\GlobalErrorHandler;
use AutomatedEmails\Original\Error\IgnitionErrorHandler;
use AutomatedEmails\Original\Dependency\Abilities\Context;

class ErrorHandlerDependency implements Cached, StaticType, Dependency
{
    static public function type(): string
    {
        return GlobalErrorHandler::class;   
    } 

    public function canBeCreated(Context $context): bool
    {
        return true;        
    } 

    public function create(): object
    {
        return new IgnitionErrorHandler;       
    } 
}