<?php

namespace AutomatedEmails\App\Domain\Conditions\Templates;

use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;
use function AutomatedEmails\Original\Utilities\Collection\_;

class PassableCompositeConditionsTemplate implements TemplateDefinition
{
    public function definition(): Collection
    {
        return _(
            type: Types::STRING, //all must pass, etc
            conditions: Types::COLLECTION // a collection of Condition templates
        );
    } 
}