<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Construction\FactoryOverloader;
use AutomatedEmails\Original\Dependency\Abilities\DynamicType;

class DynamicTypeFactory
{
    public function __construct(
        protected FactoryOverloader $factoryOverloader
    ) {}

    public function create(string $dependencyType) : DynamicType
    {
        (object) $dynamicTypeFactory = $this->factoryOverloader->overload($dependencyType);

        return $dynamicTypeFactory->create($dependencyType);
    }
}