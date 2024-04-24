<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Data\Finders\Automatedemails\AutomatedEmailsStructure;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;

class AutomatedEmailsStructureDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    static public function type(): string
    {
        return AutomatedEmailsStructure::class;   
    } 

    public function create(): object
    {
        return new AutomatedEmailsStructure;
    } 
}