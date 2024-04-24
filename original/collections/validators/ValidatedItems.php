<?php

namespace AutomatedEmails\Original\Collections\Validators;

use AutomatedEmails\Original\Abilities\GettableCollection;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Validator;
use Exception;

class ValidatedItems extends Validator implements GettableCollection
{
    public function __construct(
        protected Collection $items,
        protected Validator $validator
    ) {}
    
    public function get(): Collection
    {
        $this->validator->validate();

        return $this->items;    
    } 

    public function execute(): ValidationResult
    {
        return $this->passWhen($this->validator->isValid());
    } 

    protected function getDefaultException(): Exception
    {
        return $this->validator->getException();       
    } 
}