<?php

namespace AutomatedEmails\Original\Construction;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Validators\ItemsAreOnlyInstancesOf;
use AutomatedEmails\Original\Construction\Abilities\Overloadable;
use AutomatedEmails\Original\Construction\Abilities\OverloadableFactory;
use Exception;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\validate;

class FactoryOverloader implements Overloadable
{
    public function __construct(
        protected Collection $overloadableFactories
    ) {
        validate(new ItemsAreOnlyInstancesOf(
            allowedTypes: _(OverloadableFactory::class),
            items: $overloadableFactories, 
        ));
    }

    public function overload(mixed $value) : object
    {
        return $this->overloadableFactories->find(
            fn(OverloadableFactory $overloadableFactory) => $overloadableFactory->canCreate(
                $value
            )
        ) ?? $this->throwExceptionWhenNotFound();
    }

    protected function throwExceptionWhenNotFound() : void
    {
        throw new Exception("No overloadableFactory found!");
    }
}