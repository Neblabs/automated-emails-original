<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Dependency\Abilities\Context;

class UserRolesDependency implements Cached, StaticType, Dependency
{
    static public function type(): string
    {
        return Collection::class;        
    } 

    public function canBeCreated(Context $context): bool
    {
        return $context->nameIs('userRoles');
    } 

    public function create(): object
    {
        return new Collection([]);   
    } 
}