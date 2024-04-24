<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Dependency\Abilities\Context;

class PostStatusesDependency implements Cached, StaticType, Dependency
{
    static public function type(): string
    {
        return Collection::class;   
    } 

    public function canBeCreated(Context $context): bool
    {
        return $context->nameIs('postStatuses');    
    } 

    public function create(): Collection
    {
        // the statuses are registered after the 'init' event. See DefaultPostStatusesRegistrator
        // this collection is the instance that the DefaultPostStatusesRegistrator will add
        // the statuses to.
        // and it will be the instance passed when requested
        return new Collection([]);
    } 
}