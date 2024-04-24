<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Construction\FactoryOverloader;

use function AutomatedEmails\Original\Utilities\Collection\_;

class ProductionDynamicTypeFactory
{
    public function create() : DynamicTypeFactory
    {
        return new DynamicTypeFactory(
            new FactoryOverloader(_(
                new DependentDynamicTypeFactory,
                new DependencyDynamicTypeFactory,
            ))
        );
    }
}