<?php

namespace AutomatedEmails\Original\Construction\Abilities;

use AutomatedEmails\Original\Dependency\Abilities\Context;

use ReflectionParameter;

interface ContextFactory
{
    public function create(mixed $value) : Context;
}