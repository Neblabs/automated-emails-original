<?php

namespace AutomatedEmails\Original\Validation\Validators;

use AutomatedEmails\Original\Validation\Exceptions\ValidationException;
use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\ClassImplementsInterface;
use Exception;
use ReflectionClass;

Class DuckInterfaceIsImplemented extends Validator
{
    public function __construct(
        protected string $interface,
        protected string $implementation
    ) {}
    
    public function execute() : ValidationResult
    {
        return $this->passWhen(
            new ClassImplementsInterface($this->interface, $this->implementation)
        )->andWhen(
            new DuckMethodsAreImplementedCorrectly($this->interface, $this->implementation)
        );
    }

    protected function getDefaultException() : Exception
    {
        return new ValidationException;
    }
}