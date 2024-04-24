<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Construction\Abilities\ContextFactory;
use AutomatedEmails\Original\Construction\Abilities\OverloadableFactory;
use AutomatedEmails\Original\Dependency\Abilities\Context;

class PassThroughContextFactory implements ContextFactory, OverloadableFactory
{
    public function canCreate(mixed $value): bool
    {
        return $value instanceof Context;
    } 

    /** @param Context $value */
    public function create(mixed $value): Context
    {
        return $value;       
    } 
}