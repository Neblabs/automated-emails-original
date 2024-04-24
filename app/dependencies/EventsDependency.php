<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Creation\Entities\Events\FromStringsEventsFactory;
use AutomatedEmails\App\Creation\Entities\OnlyValidEntitiesFactory;
use AutomatedEmails\App\Data\Finders\Events\EventsFinder;
use AutomatedEmails\App\Data\Finders\Events\EventStructure;
use AutomatedEmails\App\Domain\Events\Events;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Abilities\UnCached;
use AutomatedEmails\Original\Data\Drivers\SQL\WordPressDatabaseReadableDriver;
use AutomatedEmails\Original\Data\Query\SQLParameters;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\Abilities\Context;

use wpdb;

class EventsDependency implements UnCached, StaticType, Dependency
{
    public function __construct(
        protected EventsFinder $eventsFinder
    ) {}
    
    static public function type(): string
    {
        return Events::class;
    } 

    public function canBeCreated(Context $context): bool
    {
        return true;        
    } 

    public function create(): Events
    {
        //not being used fttb
        return new Events([]);
        return $this->eventsFinder->onePerType()->findThem();
    } 
}