<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Construction\Abilities\ContextFactory;
use AutomatedEmails\Original\Dependency\Dependent;

class DependentFactory 
{
    public function __construct(
        protected DynamicTypeFactory $dynamicTypeFactory,
        protected ContextFactory $contextFactory
    ) {}
    
    public function create(string $type) : Dependent
    {
        return new Dependent(
            $this->dynamicTypeFactory->create($type),
            $this->contextFactory
        );
    }
}
