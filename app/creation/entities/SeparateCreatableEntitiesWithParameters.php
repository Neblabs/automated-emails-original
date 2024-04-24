<?php

namespace AutomatedEmails\App\Creation\Entities;

use AutomatedEmails\App\Creation\Abilities\CanCreateEntities;
use AutomatedEmails\App\Creation\Abilities\CanCreateEntitiesWithParameters;
use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\App\Creation\Abilities\CanCreateEntityWithParameters;
use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Abilities\CreatableEntitiesWithParameters;
use AutomatedEmails\Original\Data\Query\Parameters;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

class SeparateCreatableEntitiesWithParameters implements CreatableEntitiesWithParameters
{
    public function __construct(
        protected CanCreateEntityWithParameters|CanCreateEntity $entityFactory,
        protected CanCreateEntitiesWithParameters|CanCreateEntities $entitiesFactory
    ) {}
    
    public function createEntity(mixed $data, Parameters $parameters): Entity
    {
        return $this->entityFactory->createEntity($data, $parameters);
    } 

    public function createEntities(mixed $entitesData, Parameters $parameters): Entities
    {
        return $this->entitiesFactory->createEntities($entitesData, $parameters);
    } 
}