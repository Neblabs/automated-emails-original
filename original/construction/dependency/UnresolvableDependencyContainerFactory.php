<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Abilities\CreatableContainers;
use AutomatedEmails\Original\Dependency\UnresolvableDependencyContainer;

use function AutomatedEmails\Original\Utilities\Collection\_;

class UnresolvableDependencyContainerFactory implements CreatableContainers
{
    public function create(): Collection
    {
        return _(
            new UnresolvableDependencyContainer
        );
    }  
}