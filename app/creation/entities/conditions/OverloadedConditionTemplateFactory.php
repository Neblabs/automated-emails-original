<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Creation\Entities\Abilities\ConditionTemplateFactory;
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Construction\FactoryOverloader;

class OverloadedConditionTemplateFactory extends FactoryOverloader implements ConditionTemplateFactory
{   
    public function create(string $type): TemplateDefinition
    {
        /** @var ConditionTemplateFactory */
        (object) $templateFactory = $this->overload($type);

        return $templateFactory->create($type);
    } 
}