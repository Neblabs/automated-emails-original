<?php

namespace AutomatedEmails\Original\Dependency\BuiltIn;

use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Construction\Events\HookFactory;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\Abilities\Context;

class HookFactoryDependency implements Cached, StaticType, Dependency
{
    static public function type(): string
    {
        return HookFactory::class;   
    } 

    public function canBeCreated(Context $context): bool
    {
        return true;        
    } 

    public function create(): object
    {
        return new HookFactory;       
    } 
}