<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Abilities\CreatableContainers;
use AutomatedEmails\Original\Dependency\DependenciesContainerContainer;

use function AutomatedEmails\Original\Utilities\Collection\_;

class DependenciesContainerContainerFactory implements CreatableContainers
{
    public function create(): Collection
    {
        return _(
            new DependenciesContainerContainer
        );
    } 
}