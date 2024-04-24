<?php

namespace AutomatedEmails\App\Domain\Templates;

use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

abstract class EntityTemplates extends Entities
{
    abstract static protected function entitiesClass() : string;

    protected function getDomainClass(): string
    {
        return Entity::class;        
    } 

    public function create(DataSetCollection $dataSetCollection) : Entities
    {
        (string) $entities = static::entitiesClass();

        return new $entities(
            //$this->entities->map()->create($dataSetCollection)
            $this->entities->map(
                fn(EntityTemplate $entityTemplate) => $entityTemplate->create($dataSetCollection)  
            )
        );
    }
}