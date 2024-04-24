<?php

namespace AutomatedEmails\Original\Construction\Dependency;

use AutomatedEmails\Original\Construction\Abilities\OverloadableFactory;
use AutomatedEmails\Original\Dependency\Abilities\DynamicType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\SameType;

class DependentDynamicTypeFactory implements OverloadableFactory
{
    /** @param string $value */
    public function canCreate(mixed $value): bool
    {
        return !is_a($value, Dependency::class, allow_string: true);
    } 

    public function create(string $type) : DynamicType
    {
        return new SameType($type);
    }
}