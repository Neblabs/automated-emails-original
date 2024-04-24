<?php

namespace AutomatedEmails\Original\Dependency;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Validators\ItemsAreOnlyInstancesOf;
use Exception;
use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\validate;

class Old_Container
{
    public function __construct(
        protected Collection $dependencies
    ) {
        validate(
            new ItemsAreOnlyInstancesOf(
                items: $dependencies,
                allowedTypes: _(Dependency::class)
            )
        );
    }

    public function inject(string $fullyQualifiedTypeName) : object
    {
        return $this->dependenciesForType($fullyQualifiedTypeName)->first();
    }

    protected function dependenciesForType(string $fullyQualifiedTypeName) : Collection
    {
        return $this->dependencies->get($fullyQualifiedTypeName) 
                ?? 
               throw new Exception(
                    "No registered dependency for type: {$fullyQualifiedTypeName}"
                );
    }
    
}