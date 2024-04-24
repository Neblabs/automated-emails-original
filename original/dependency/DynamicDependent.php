<?php

namespace AutomatedEmails\Original\Dependency;

use AutomatedEmails\Original\Dependency\Abilities\DynamicType;

class DynamicDependent implements DynamicType
{
    public function type(): string
    {
        return $this->type;
    } 
}