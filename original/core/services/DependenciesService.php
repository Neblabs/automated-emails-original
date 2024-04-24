<?php

namespace AutomatedEmails\Original\Core\Services;

use AutomatedEmails\Original\Abilities\GettableCollection;
use AutomatedEmails\Original\Construction\Dependency\ProductionDependenciesContainerFactory;
use AutomatedEmails\Original\Core\Abilities\Service;
use AutomatedEmails\Original\Core\Abilities\ServicesContainer;
use AutomatedEmails\Original\Dependency\DependenciesContainer;

class DependenciesService implements Service
{
    protected ?DependenciesContainer $dependenciesContainer;

    public function __construct(
        protected ProductionDependenciesContainerFactory $dependenciesContainerFactory,
        protected GettableCollection $dependencyTypes
    ) {}
    
    public function id(): string
    {
        return 'dependencies';
    } 

    public function container() : ?DependenciesContainer
    {
        return $this->dependenciesContainer;
    }

    public function start(ServicesContainer $servicesContainer): void
    {
        $this->dependenciesContainer = $this->dependenciesContainerFactory->create(
            dependencyTypes: $this->dependencyTypes
        );
    } 

    public function stop(ServicesContainer $servicesContainer): void
    {
        $this->dependenciesContainer = null;
    } 
}