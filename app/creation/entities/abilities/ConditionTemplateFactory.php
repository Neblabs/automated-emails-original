<?php

namespace AutomatedEmails\App\Creation\Entities\Abilities;

use AutomatedEmails\App\Components\Abilities\ConditionComponent;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;

interface ConditionTemplateFactory
{
    public function create(string $type) : TemplateDefinition; 
}