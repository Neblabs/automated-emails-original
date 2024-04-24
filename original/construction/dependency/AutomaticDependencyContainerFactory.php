<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Abilities\CreatableContainers;
use AutomatedEmails\Original\Dependency\AutomaticDependencyContainer;

use function AutomatedEmails\Original\Utilities\Collection\_;

class AutomaticDependencyContainerFactory implements CreatableContainers
{
    public function __construct(
        protected DynamicTypeFactory $dynamicTypeFactory
    ) {}
    
    public function create(): Collection
    {
        return _(
            new AutomaticDependencyContainer(
                new DependentFactory(
                    $this->dynamicTypeFactory,
                    new KnownContextFactory
                )
            )
        );
    }  
}