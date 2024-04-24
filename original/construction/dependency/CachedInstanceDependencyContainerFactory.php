<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Construction\Abilities\ContainerFactory;
use AutomatedEmails\Original\Construction\Abilities\DependencyContainerFactory;
use AutomatedEmails\Original\Construction\Abilities\OverloadableFactory;
use AutomatedEmails\Original\Dependency\CachedInstanceDependencyContainer;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\Container;

class CachedInstanceDependencyContainerFactory implements 
    ContainerFactory, 
    OverloadableFactory
{
    /** @var Dependency */
    public function canCreate(mixed $value): bool
    {
        return $value instanceof Dependency && $value instanceof Cached;
    } 

    /** @var Dependency */
    public function create(string|Dependency $dependency): Container
    {
        return new CachedInstanceDependencyContainer($dependency);
    } 
}