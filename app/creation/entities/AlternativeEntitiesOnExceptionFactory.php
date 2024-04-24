<?php

namespace AutomatedEmails\App\Creation\Entities;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;
use Exception;
use Throwable;

class AlternativeEntitiesOnExceptionFactory implements CreatableEntities
{
    public function __construct(
        protected CreatableEntities $tryEntitiesFactory,
        protected CreatableEntities $onExceptionEntitiesFactory
    ) {}

    public function createEntity(mixed $data): Entity
    {
        return $this->createEntityOrEntities(entityOrEntities: 'entity', data: $data);
    } 

    public function createEntities(mixed $entitesData): Entities
    {
        return $this->createEntityOrEntities(entityOrEntities: 'entities', data: $entitesData);
    } 

    protected function createEntityOrEntities(string $entityOrEntities, mixed $data) : Entity|Entities
    {
        /*string*/ $create = match($create = $entityOrEntities) {
            'entity' => 'createEntity',
            'entities' => 'createEntities'
        };

        try {
            (object) $entity = $this->tryEntitiesFactory->{$create}($data);
        } catch (Throwable) {
            (object) $entity = $this->onExceptionEntitiesFactory->{$create}($data);
        }

        return $entity;  
    }
}