<?php

namespace AutomatedEmails\App\Creation\Templates;

use AutomatedEmails\App\Creation\Abilities\CreatableEntitiesWithParameters;
use AutomatedEmails\App\Creation\Entities\Abilities\OverloadableEntitiesFactory;
use AutomatedEmails\Original\Data\Query\Parameters;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

use function AutomatedEmails\Original\Utilities\Collection\_;

class MetaValueToEntitiesWithParametersFactory implements CreatableEntitiesWithParameters, OverloadableEntitiesFactory
{
    protected ArrayValueToEntitiesWithParametersFactory $arrayValueToEntitiesFactory;

    public function __construct(
        CreatableEntitiesWithParameters $entitiesFactory
    ) {
        $this->arrayValueToEntitiesFactory =  new ArrayValueToEntitiesWithParametersFactory(
            key: 'meta_value',
            entitiesFactory: $entitiesFactory
        );
    }
    
    public function canCreateEntity(mixed $data): bool
    {
        return $this->arrayValueToEntitiesFactory->canCreateEntity($data) && isset($data['meta_value']);    
    } 

    public function canCreateEntities(mixed $data): bool
    {
        return $this->arrayValueToEntitiesFactory->canCreateEntities($data);
    } 

    public function createEntity(mixed $data, Parameters $parameters): Entity
    {
        return $this->arrayValueToEntitiesFactory->createEntity($data, $parameters);
    } 

    public function createEntities(mixed $entitesData, Parameters $parameters): Entities
    {
        return $this->arrayValueToEntitiesFactory->createEntities($entitesData, $parameters);
    } 
}