<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\DependencyInspector;
use AutomatedEmails\Original\Dependency\Dependent;

class DependencyFactory
{
    public function __construct(
        protected DependencyInspectorFactory $dependencyInspectorFactory,
        protected DependentFactory $dependentFactory
    ) {}
    
    public function create(string $type) : Dependency
    {
        (object) $dependencyInspector = $this->dependencyInspectorFactory->create($type);

        return match(true) {
            $dependencyInspector->hasDependencies() => $this->dependentFactory->create($type),
            $dependencyInspector->isDependency() => new $type
        };
    }
}