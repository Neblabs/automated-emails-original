<?php

namespace AutomatedEmails\Original\Dependency;

use AutomatedEmails\Original\Dependency\Abilities\DynamicType;

class SameType implements DynamicType
{
    public function __construct(
        protected string $type
    ) {}
    
    public function type(): string
    {
        return $this->type;
    } 

    public function defaultType() : string
    {
        return $this->type;
    } 
}