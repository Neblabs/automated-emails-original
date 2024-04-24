<?php

namespace AutomatedEmails\Original\Dependency\Abilities;

interface DynamicType
{
    public function type() : string; 
    public function defaultType() : string; 
}