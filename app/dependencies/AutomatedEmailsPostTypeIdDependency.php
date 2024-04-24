<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Data\Finders\Automatedemails\AutomatedEmailsStructure;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Dependency\Abilities\Context;

use function AutomatedEmails\Original\Utilities\Text\i;

class AutomatedEmailsPostTypeIdDependency implements Cached, StaticType, Dependency
{
    public function __construct(
        protected AutomatedEmailsStructure $automatedEmailsStructure
    ) {}
    
    static public function type(): string
    {
        return StringManager::class;     
    } 

    public function canBeCreated(Context $context): bool
    {
        return $context->nameIs('automatedEmailsPostTypeId');
    } 

    public function create(): StringManager
    {
        return i($this->automatedEmailsStructure->fields()->id()->id()->get());
    } 
}