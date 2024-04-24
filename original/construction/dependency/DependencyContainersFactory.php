<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Abilities\ContainerFactory;
use AutomatedEmails\Original\Construction\Abilities\CreatableContainers;

class DependencyContainersFactory implements CreatableContainers
{
    public function __construct(
        protected Collection $dependencyTypes,
        protected ContainerFactory $dependencyContainerFactory
    ) {}
    
    public function create() : Collection
    {
        return $this->dependencyTypes->map($this->dependencyContainerFactory->create(...));
    }
}