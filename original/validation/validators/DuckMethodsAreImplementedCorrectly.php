<?php

namespace AutomatedEmails\Original\Validation\Validators;

use AutomatedEmails\Original\Abilities\Methods;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Exceptions\InvalidImplementationException;
use AutomatedEmails\Original\Validation\Exceptions\ValidationException;
use AutomatedEmails\Original\Validation\PassingValidationResult;
use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Validator;
use Exception;
use ReflectionAttribute;
use ReflectionClass;
use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\i;

Class DuckMethodsAreImplementedCorrectly extends Validator
{

    protected ReflectionClass $duckInterfaceReflection;
    protected ReflectionClass $implementationReflection;

    public function __construct(
        protected string $interface,
        protected string $implementation
    ) {
        $this->duckInterfaceReflection = new ReflectionClass($interface);
        $this->implementationReflection = new ReflectionClass($implementation);
    }

    public function execute() : ValidationResult
    {
        //   if (version_compare(PHP_VERSION, '8.0.0', '<')) {
            return new PassingValidationResult();
       // }
        
        foreach ($this->interfaceMethods()->names() as $methodName) {
            if (!$this->implementationReflection->hasMethod($methodName)) {
                return $this->failed()->withException(
                    new InvalidImplementationException("Missing required method: {$this->implementationReflection->getShortName()}::{$methodName}")
                );
            }
        }

        return $this->passWhen($this->interfaceMethods()->names()->haveAny());
    }

    protected function interfaceMethods() : Methods
    {
        return _($this->duckInterfaceReflection->getAttributes())->find(
            fn(ReflectionAttribute $reflectionAttribute) => 
                i($reflectionAttribute->getName())->toLowerCase()
                                                ->is(
                                                    i(Methods::class)->toLowerCase()
                                                )
        )->newInstance();
    }
    
    protected function getDefaultException() : Exception
    {
        return new InvalidImplementationException(
            "Class: {$this->implementationReflection->getName()} must correctly implement interface {$this->duckInterfaceReflection->getName()}"
        );
    }
}