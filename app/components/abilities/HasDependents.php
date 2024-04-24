<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\App\Components\Components;

interface HasDependents
{
    public function addDependent(Identifiable|Typeable $dependent) : void;
    public function dependents() : Components; 
}