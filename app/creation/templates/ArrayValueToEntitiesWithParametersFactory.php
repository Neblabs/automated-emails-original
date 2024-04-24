<?php

namespace AutomatedEmails\App\Creation\Templates;

use AutomatedEmails\App\Creation\Abilities\CreatableEntitiesWithParameters;
use AutomatedEmails\App\Creation\Entities\Abilities\OverloadableEntitiesFactory;
use AutomatedEmails\Original\Data\Query\Parameters;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;
use function AutomatedEmails\Original\Utilities\Collection\_;

class ArrayValueToEntitiesWithParametersFactory implements CreatableEntitiesWithParameters, OverloadableEntitiesFactory
{
    public function __construct(
        protected string $key,
        protected CreatableEntitiesWithParameters $entitiesFactory,
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

    public function createEntity(mixed $data, Parameters $parameters): Entity
    {
        return $this->entitiesFactory->createEntity($data[$this->key], $parameters);
    } 

    public function createEntities(mixed $entitesData, Parameters $parameters): Entities
    {
        (array) $values = _($entitesData)->map(
            fn($entityData) => ($entityData)[$this->key]
        )->asArray();

        return $this->entitiesFactory->createEntities($values, $parameters);  
    } 
}