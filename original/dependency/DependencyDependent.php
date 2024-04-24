<?php

namespace AutomatedEmails\Original\Dependency;

class DependencyDependent extends Dependent
{
    public function type(): string
    {
        return ($this->type)::type();
    } 
}