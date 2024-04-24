<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Dependency\DependencyInspector;

class DependencyInspectorFactory
{
    public function create(string $dependencyClassName) : DependencyInspector
    {
        return new DependencyInspector($dependencyClassName);
    }
}