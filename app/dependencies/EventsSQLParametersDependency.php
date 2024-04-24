<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Data\Finders\Events\EventStructure;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Data\Query\SQLParameters;
use AutomatedEmails\Original\Dependency\Abilities\Context;
use NilPortugues\Sql\QueryBuilder\Builder\MySqlBuilder;

class EventsSQLParametersDependency implements Cached, StaticType, Dependency
{
    public function __construct(
        protected EventStructure $eventStructure
    ) {}
    
    static public function type(): string
    {
        return SQLParameters::class;   
    } 

    public function canBeCreated(Context $context): bool
    {
        return $context->nameIs('eventsSQLParameters');    
    } 

    public function create(): object
    {
        (object) $SQLParameters = new SQLParameters($this->eventStructure);

        $SQLParameters->setBuilder(new MySqlBuilder);

        return $SQLParameters;
    } 
}