<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;

interface HasTemplateOptions
{
    public function options() : TemplateDefinition; 
}