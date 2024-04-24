<?php

namespace AutomatedEmails\Original\Collections\Validators;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Exceptions\ValidationException;
use AutomatedEmails\Original\Validation\Validator;
use Exception;

Class CollectionHasItem extends Validator
{
    public function __construct(
        protected Collection $items,
        protected mixed $item,
        protected bool $shouldHaveIt = true
    ) {}
    
    public function execute() : ValidationResult
    {
        (boolean) $hasItem = $this->items->have(fn(mixed $item) => $item === $this->item);

        return $this->passWhen(
            $this->shouldHaveIt? $hasItem : !$hasItem
        );
    }

    protected function getDefaultException() : Exception
    {
        return new ValidationException;
    }
}