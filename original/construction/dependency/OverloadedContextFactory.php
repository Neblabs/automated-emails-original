<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Construction\Abilities\ContextFactory;
use AutomatedEmails\Original\Construction\FactoryOverloader;
use AutomatedEmails\Original\Dependency\Abilities\Context;

use ReflectionParameter;


class OverloadedContextFactory implements ContextFactory
{
    public function __construct(
        protected FactoryOverloader $factoryOverloader
    ) {}
    
    // ONLY ALLOWED INSIDE CLASS METHODS!
    // 
    // MAYBE MAKE SURE THAT THE $reflectionParameter->getDeclaringClass()
    // IS THE ACTUAL CONCTRETE CLASS AND NOT A BASE CLASS OR AN INTERFACE
    // OTHERWISE IT COULD BE THE SOURCE OF SOME NASTY BUGS!  
    // 
    // IT'S NOT CLEAR IN THE DOVUMENTATION AND getClass() IS DEPRECATED!
    /** @param ReflectionParameter $value */
    public function create(mixed $value) : Context
    {
        /** @var ContextFactory */
        (object) $contextFactory = $this->factoryOverloader->overload($value);

        return $contextFactory->create($value);
    }
}