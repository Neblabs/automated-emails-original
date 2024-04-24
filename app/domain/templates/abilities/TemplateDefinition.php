<?php

namespace AutomatedEmails\App\Domain\Templates\Abilities;

use AutomatedEmails\Original\Collections\Collection;

interface TemplateDefinition
{
    public function definition() : Collection; 
}