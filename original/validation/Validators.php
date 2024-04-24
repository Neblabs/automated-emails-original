<?php

namespace AutomatedEmails\Original\Validation;

use AutomatedEmails\Original\Validation\Exceptions\ValidationException;
use AutomatedEmails\Original\Validation\PassingValidationResult;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\ValidType;
use Exception;

Class Validators extends Validator
{
    private $vaildators;

    public function __construct(Iterable $validators)       
    {
        $this->validateOnlyHasValidator($validators);

        $this->validators = $validators;
    }
    
    public function execute() : ValidationResult
    {
        foreach ($this->validators as $validator) {
            $validator->validate();
        }

        return new PassingValidationResult;
    }

    protected function validateOnlyHasValidator(Iterable $validators)
    {
        foreach ($validators as $validator) {
            (object) $isValidatorType = new ValidType($validator, Validator::class);

            $isValidatorType->validate();
        }
    }

    protected function getDefaultException() : Exception
    {
        return new ValidationException;
    }
}