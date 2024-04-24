<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Data\Finders\Recipients\RecipientStructure;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Data\Query\SQLParameters;
use AutomatedEmails\Original\Dependency\Abilities\Context;
use NilPortugues\Sql\QueryBuilder\Builder\MySqlBuilder;
use stdClass;

class RecipientSQLParametersDependency implements Cached, StaticType, Dependency
{
    static public function type(): string
    {
        return SQLParameters::class;        
    } 

    public function canBeCreated(Context $context): bool
    {
        return $context->nameIs('recipientSQLParameters');
    } 

    public function create(): SQLParameters
    {
        (object) $SQLParameters =  new SQLParameters(
            new RecipientStructure
        );

        $SQLParameters->setBuilder(new MySqlBuilder);

        return $SQLParameters;
    } 
}