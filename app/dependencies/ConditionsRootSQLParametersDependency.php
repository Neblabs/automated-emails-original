<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Data\Finders\ConditionsRoot\ConditionsRootStructure;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Data\Query\SQLParameters;
use AutomatedEmails\Original\Dependency\Abilities\Context;
use NilPortugues\Sql\QueryBuilder\Builder\MySqlBuilder;

class ConditionsRootSQLParametersDependency implements Cached, StaticType, Dependency
{
    static public function type(): string
    {
        return SQLParameters::class;   
    } 

    public function canBeCreated(Context $context): bool
    {
        return $context->nameIs('conditionsRootSQLParameters');    
    } 

    public function create(): object
    {
        (object) $SQLParameters =  new SQLParameters(
            new ConditionsRootStructure
        );

        $SQLParameters->setBuilder(new MySqlBuilder);

        return $SQLParameters;
    } 
}