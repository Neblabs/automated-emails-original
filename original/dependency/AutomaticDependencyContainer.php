<?php

namespace AutomatedEmails\Original\Dependency;

use AutomatedEmails\Original\Construction\Dependency\DependentFactory;
use AutomatedEmails\Original\Dependency\Abilities\Context;
use Exception;
use ReflectionClass;

class AutomaticDependencyContainer implements Container
{
    protected DependenciesContainer $dependenciesContainer;

    public function __construct(
        protected DependentFactory $dependentFactory
    ) {}
    
    public function matches(string $type, Context $context): bool
    {
        return $this->isConcreteClass($type) && $this->dependentFactory->create($type)->canBeCreated($context);
    } 

    public function get(string $type): object
    {
        (object) $dependent = $this->dependentFactory->create($type);

        $dependent->setDependenciesContainer($this->dependenciesContainer);

        return $dependent->create();
    } 

    public function setDependenciesContainer(DependenciesContainer $dependenciesContainer): void
    {
        $this->dependenciesContainer = $dependenciesContainer;
    } 

    protected function isConcreteClass(string $type) : bool
    {
        try {
            (object) $reflectedType = new ReflectionClass($type);

            return $reflectedType->isInstantiable(); 
          } catch (Exception) {
              return false;
          }  
    }
    
}