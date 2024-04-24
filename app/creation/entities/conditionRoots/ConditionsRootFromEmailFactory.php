<?php

namespace AutomatedEmails\App\Creation\Entities\Conditionroots;

use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Abilities\CreatableEntitiesWithParameters;
use AutomatedEmails\App\Creation\Entities\SeparateCreatableEntities;
use AutomatedEmails\App\Data\Finders\ConditionsRoot\ConditionsRootFinder;
use AutomatedEmails\App\Domain\AutomatedEmails\AutomatedEmail;
use AutomatedEmails\App\Domain\Data\Abilities\Datasetcolectiongetters\DataSetCollectionFromEmail;
use AutomatedEmails\Original\Data\Drivers\Abilities\ReadableDriver;
use AutomatedEmails\Original\Data\Query\SQLParameters;
use AutomatedEmails\Original\Domain\Entity;

class ConditionsRootFromEmailFactory implements CanCreateEntity
{
    public function __construct(
        protected ReadableDriver $readableDriver,
        protected SQLParameters $conditionsRootSQLParameters,
        protected ConditionsRootEntitiesFactoryFromEmail $conditionsRootEntitiesFactoryFromEmail
    ) {}
    
    /** @param AutomatedEmail $data */
    public function createEntity(mixed $data): Entity
    {
        (object) $conditionsRootFinder = new ConditionsRootFinder(
            readableDriver: $this->readableDriver, 
            parameters: $this->conditionsRootSQLParameters,
            entityFactory: $this->conditionsRootEntitiesFactoryFromEmail->create(
                $data
            )
        );

        return $conditionsRootFinder->forEmail($data)->findIt(); 
    } 
}