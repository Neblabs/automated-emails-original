<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Abilities\ContainerFactory;
use AutomatedEmails\Original\Construction\Abilities\CreatableContainers;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\Container;

class DependencyTypeToContainerFactory implements ContainerFactory
{
    public function __construct(
        protected DependencyFactory $dependencyFactory,
        protected DependencyContainerFactory $dependencyContainerFactory
    ) {}
    
    /** @var string */
    public function create(string|Dependency $dependency): Container
    {
        return $this->dependencyContainerFactory->create(
            $this->dependencyFactory->create($dependency)
        );
    } 
}