<?php

namespace AutomatedEmails\Original\Collections\Validators;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Exceptions\ValidationException;
use AutomatedEmails\Original\Validation\Validator;
use Exception;

Class CollectionHasItems extends Validator
{
    public function __construct(
        protected Collection $collection,
        protected Collection $itemsToCheck,
        protected string $permission,
        protected string $quantifier
    ) {}
    
    public function execute() : ValidationResult
    {
        /*bool*/ $collectionHasThem = match($this->quantifier) {
            'any' => $this->collection->containAny($this->itemsToCheck),
            'all' => $this->collection->containAll($this->itemsToCheck),
        };
        
        $matches = match($this->permission) {
            'allowed' => $collectionHasThem,
            'forbidden' => !$collectionHasThem,
            default => false
        };
        
        return $this->passWhen($matches);
    }

    protected function getDefaultException() : Exception
    {
        return new ValidationException;
    }
}