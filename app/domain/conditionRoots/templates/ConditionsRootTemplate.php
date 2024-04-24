<?php

namespace AutomatedEmails\App\Domain\ConditionRoots\Templates;

use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;

use function AutomatedEmails\Original\Utilities\Collection\_;

class ConditionsRootTemplate implements TemplateDefinition
{
    public function definition(): Collection
    {
        return _(
            type: Types::STRING, //allmustpass, etc,
            subjectConditions: Types::COLLECTION // a collection of subject conditions
        );
    }  
}