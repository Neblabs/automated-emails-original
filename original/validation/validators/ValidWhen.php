<?php

namespace AutomatedEmails\Original\Validation\Validators;

use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Exceptions\ValidationException;
use AutomatedEmails\Original\Validation\Validator;
use Closure;
use Exception;

Class ValidWhen extends Validator
{
    public function __construct(
        protected bool|Closure $value,
        protected ?Exception $exception = null
    ) {}
    
    public function execute() : ValidationResult
    {
        (boolean) $value = is_callable($this->value)? (($this->value)()) : $this->value;

        return $this->passWhen($value === true);
    }

    protected function getDefaultException() : Exception
    {
        return $this->exception ?? new ValidationException;
    }
}