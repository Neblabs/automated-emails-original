<?php

namespace AutomatedEmails\Original\Validation\Validators;

use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Exceptions\ValidationException;
use AutomatedEmails\Original\Validation\{Validator};
use Exception;

Class FailingValidator extends Validator
{
    public function execute() : ValidationResult
    {
        return $this->passWhen(false);
    }

    protected function getDefaultException() : Exception
    {
        return new ValidationException;
    }
}