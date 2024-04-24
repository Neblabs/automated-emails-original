<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Domain\Conditions\Templates\PassableCompositeConditionsTemplate;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Collections\JSONMapper;
use AutomatedEmails\Original\Dependency\Abilities\Context;

class PassableCompositeConditionsMapperDependency implements Cached, StaticType, Dependency
{
    static public function type(): string
    {
        return JSONMapper::class;       
    } 

    public function canBeCreated(Context $context): bool
    {
        return $context->nameIs('passableCompositeConditionsMapper');
    } 

    public function create(): object
    {
        (object) $passableCompositeConditionsTemplate = new PassableCompositeConditionsTemplate;

        return new JSONMapper(map: $passableCompositeConditionsTemplate->definition());       
    } 
}