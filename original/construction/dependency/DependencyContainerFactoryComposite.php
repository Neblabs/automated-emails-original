<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Construction\Abilities\ContainerFactory;
use AutomatedEmails\Original\Construction\Abilities\DependencyContainerFactory;
use AutomatedEmails\Original\Construction\FactoryOverloader;
use AutomatedEmails\Original\Dependency\Container;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\DependencyContainer;

class DependencyContainerFactoryComposite implements ContainerFactory
{
    public function __construct(
        protected FactoryOverloader $factoryOverloader
    ) {}

    public function create(string|Dependency $dependency) : Container
    {
        /** @var DependencyContainerFactory */
        (object) $dependencyContainerFactory = $this->factoryOverloader->overload($dependency);

        return $dependencyContainerFactory->create($dependency);
    }
}