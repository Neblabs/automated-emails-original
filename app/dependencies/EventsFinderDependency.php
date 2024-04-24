<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Creation\Abilities\CreatableEntitiesWithParameters;
use AutomatedEmails\App\Creation\Entities\Conditionroots\ConditionsRootFromTemplateFactory;
use AutomatedEmails\App\Creation\Entities\Conditions\ConditionsFromTemplateFactory;
use AutomatedEmails\App\Creation\Entities\Events\FromStringsEventsFactory;
use AutomatedEmails\App\Creation\Entities\ExceptionWhenCannotCreateFactory;
use AutomatedEmails\App\Creation\Entities\OnlyValidEntitiesFactory;
use AutomatedEmails\App\Creation\Templates\ArrayValueToEntitiesFactory;
use AutomatedEmails\App\Creation\Templates\ArrayValueToEntitiesWithParametersFactory;
use AutomatedEmails\App\Data\Finders\Events\EventsFinder;
use AutomatedEmails\App\Data\Finders\Events\EventStructure;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Data\Drivers\SQL\WordPressDatabaseReadableDriver;
use AutomatedEmails\Original\Data\Query\SQLParameters;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\Abilities\Context;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use wpdb;

class EventsFinderDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;
    
    public function __construct(
        protected WordPressDatabaseReadableDriver $wordPressDatabaseReadableDriver,
        protected EventStructure $eventStructure,
        protected SQLParameters $eventsSQLParameters,
        protected FromStringsEventsFactory $fromStringsEventsFactory
    ) {}
    
    static public function type(): string
    {
        return EventsFinder::class;   
    } 

    public function create(): EventsFinder
    {
        (object) $eventsFinder = new EventsFinder(
            $this->wordPressDatabaseReadableDriver,
            $this->eventsSQLParameters,
            new ArrayValueToEntitiesWithParametersFactory(
                key: $this->eventStructure->fields()->field('value')->name()->get(),
                entitiesFactory: $this->fromStringsEventsFactory /*new ExceptionWhenCannotCreateFactory(
                    entitiesErrorMessage: "Event cannot be created, probably because Its not a valid event (it's not registered)",
                    factory: new FromStringsEventsFactory(
                        eventComponents: $this->eventComponents,
                        conditionsRootFromTemplateFactory: $this->conditionsRootFromTemplateFactory
                    )
                )*/
            )
        );

        return $eventsFinder;
    } 
}