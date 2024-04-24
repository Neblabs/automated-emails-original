<?php

namespace AutomatedEmails\App\Components;

use AutomatedEmails\App\Components\Abilities\HasDependents;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\Original\Collections\SingleItem;

class ComponentWithDependents implements HasDependents
{
    public function __construct(
        protected Components $dependents = new Components()
    ) {}
    
    public function dependents(): Components
    {
        return $this->dependents;
    } 

    public function addDependent(Identifiable|Typeable $dependent): void
    {
        $this->dependents->add(new SingleItem($dependent));
    } 
}