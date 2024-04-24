<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Construction\Abilities\ContextFactory;
use AutomatedEmails\Original\Construction\Abilities\OverloadableFactory;
use ReflectionParameter;
use AutomatedEmails\Original\Dependency\Abilities\Context;
use AutomatedEmails\Original\Dependency\UnknownContext;

class UnknownContextFactory implements ContextFactory, OverloadableFactory
{
    // this is the default factory so it should ALWAYS CREATE!
    public function canCreate(mixed $value): bool
    {
        return true;    
    } 

    /** @param ReflectionParameter $value */
    public function create(mixed $value): Context
    {
        return new UnknownContext;
    } 
}