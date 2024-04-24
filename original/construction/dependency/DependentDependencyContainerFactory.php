<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Construction\Abilities\ContainerFactory;
use AutomatedEmails\Original\Construction\Abilities\OverloadableFactory;
use AutomatedEmails\Original\Construction\Dependency\DependencyContainerFactory;
use AutomatedEmails\Original\Dependency\Container;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\Dependent;
use AutomatedEmails\Original\Dependency\DependentDependencyContainer;

class DependentDependencyContainerFactory implements 
    ContainerFactory, 
    OverloadableFactory
{
    public function __construct(
        protected DependencyInspectorFactory $dependencyInspectorFactory,
        protected DependencyContainerFactory $dependencyContainerFactory,
    ) {}

    /** @var Dependency */
    public function canCreate(mixed $value): bool
    {
        (object) $dependencyInspector = $this->dependencyInspectorFactory->create($value::class);

        return $dependencyInspector->isDependent();
    } 

    /** @var Dependent */
    public function create(string|Dependency $dependency): Container
    {
        return new DependentDependencyContainer(
            $dependency,
            $this->dependencyContainerFactory
        );
    } 

}