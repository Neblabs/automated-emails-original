<?php

namespace AutomatedEmails\Original\Validation\Validators;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Exceptions\ValidationException;
use AutomatedEmails\Original\Validation\{Validator};
use Exception;

Class CollectionHasKey extends Validator
{
    public function __construct(protected Collection $collection, protected string $key) {}
    
    public function execute() : ValidationResult
    {
        return $this->passWhen($this->collection->hasKey($this->key));
    }

    protected function getDefaultException() : Exception
    {
        return new ValidationException;
    }
}