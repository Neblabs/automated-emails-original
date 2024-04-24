<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Abilities\CreatableContainers;
use AutomatedEmails\Original\Dependency\DependencyContainer;
use AutomatedEmails\Original\Dependency\Dependent;
use AutomatedEmails\Original\Dependency\DependentDependencyContainer;
use function AutomatedEmails\Original\Utilities\Collection\_;

class ContainersFactory implements CreatableContainers
{
    public function __construct(
        protected Collection $factories,
    ) {}
    
    public function create() : Collection
    {
        return $this->factories->map(fn($factory) => $factory->create())->flatten();
    }   
}