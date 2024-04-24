<?php

namespace AutomatedEmails\Original\Data\Model;

use AutomatedEmails\App\Creation\Abilities\CreatableEntitiesWithParameters;
use AutomatedEmails\Original\Data\Drivers\Abilities\ReadableDriver;
use AutomatedEmails\Original\Data\Query\Parameters;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

abstract class Finder
{
    public function __construct(
        protected ReadableDriver $readableDriver,
        protected Parameters $parameters,
        protected CreatableEntitiesWithParameters $entityFactory,
    ) {}

    public function findIt() : Entity
    {
        $this->parameters->beforePassingToDriver();

        (object) $rawEntity = $this->readableDriver->findOne($this->parameters);
        (object) $entity = $this->entityFactory->createEntity($rawEntity, $this->parameters);

        $this->parameters->reset();

        return $entity;
    }

    public function findThem() : Entities
    {
        $this->parameters->beforePassingToDriver();

        (object) $rawEntities = $this->readableDriver->findMany($this->parameters);

        (object) $entities = $this->entityFactory->createEntities(
            $rawEntities,
            $this->parameters
        );

        $this->parameters->reset();
        
        return $entities;
    }

    public function count() : int   
    {
        return $this->readableDriver->count($this->parameters);
    }

    public function has() : bool
    {
        return $this->readableDriver->has($this->parameters);
    }
}