<?php

namespace AutomatedEmails\App\Creation\Entities;

use AutomatedEmails\App\Creation\Abilities\CanCreateEntities;
use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

class SeparateCreatableEntities implements CreatableEntities
{
    public function __construct(
        protected CanCreateEntity $entityFactory,
        protected CanCreateEntities $entitiesFactory
    ) {}
    
    public function createEntity(mixed $data): Entity
    {
        return $this->entityFactory->createEntity($data);
    } 

    public function createEntities(mixed $entitesData): Entities
    {
        return $this->entitiesFactory->createEntities($entitesData);
    } 
}