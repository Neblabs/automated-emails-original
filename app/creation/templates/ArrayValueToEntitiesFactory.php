<?php

namespace AutomatedEmails\App\Creation\Templates;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Abilities\CreatableEntitiesWithParameters;
use AutomatedEmails\App\Creation\Entities\Abilities\OverloadableEntitiesFactory;
use AutomatedEmails\Original\Data\Query\Parameters;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;
use function AutomatedEmails\Original\Utilities\Collection\_;

class ArrayValueToEntitiesFactory implements CreatableEntities, OverloadableEntitiesFactory
{
    public function __construct(
        protected string $key,
        protected CreatableEntities $entitiesFactory,
    ) {}

    public function canCreateEntity(mixed $data): bool
    {
        return is_array($data) && isset($data[$this->key]) && is_string($data[$this->key]);;
    } 

    public function canCreateEntities(mixed $data): bool
    {
        return is_array($data) && _($data)->doesNotHave(
            fn($innerData) => !$this->canCreateEntity($innerData)
        );
    } 

    public function createEntity(mixed $data): Entity
    {
        return $this->entitiesFactory->createEntity($data[$this->key]);
    } 

    public function createEntities(mixed $entitesData): Entities
    {
        (array) $values = _($entitesData)->map(
            fn($entityData) => ($entityData)[$this->key]
        )->asArray();

        return $this->entitiesFactory->createEntities($values);  
    } 
}