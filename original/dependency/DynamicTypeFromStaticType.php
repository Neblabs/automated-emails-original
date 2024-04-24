<?php

namespace AutomatedEmails\Original\Dependency;

use AutomatedEmails\Original\Dependency\Abilities\DynamicType;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;

class DynamicTypeFromStaticType implements DynamicType
{
    public function __construct(
        protected string $staticType // class implementing StaticType
    ) {}
    
    public function type(): string
    {
        return $this->staticType::type();
    } 

    public function defaultType(): string
    {
        return $this->staticType;
    } 
}