<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Construction\Abilities\ContextFactory;
use AutomatedEmails\Original\Construction\Abilities\OverloadableFactory;
use AutomatedEmails\Original\Dependency\Abilities\Context;
use AutomatedEmails\Original\Dependency\KnownContext;

use function AutomatedEmails\Original\Utilities\Text\i;

use ReflectionParameter;

class KnownContextFactory implements ContextFactory, OverloadableFactory
{
    /** @param ReflectionParameter $value */
    public function canCreate(mixed $value): bool
    {
        return  $value instanceof ReflectionParameter
                    &&
                $value->hasType() 
                    && 
                class_exists($value->getType());
    } 

    /** @param ReflectionParameter $value */
    public function create(mixed $value): Context
    {
        return new KnownContext(
            fullyQualifiedTypeName: i($value->getDeclaringClass()->getName()),
            methodName: i($value->getDeclaringFunction()->getShortName()),
            variableName: i($value->getName())
        );
    } 
}