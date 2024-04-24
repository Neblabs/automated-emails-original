<?php

namespace AutomatedEmails\App\Domain\Templates;

use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;

class EmptyTemplate implements TemplateDefinition
{
    public function definition(): Collection
    {
        return _();
    } 
}