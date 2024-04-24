<?php

namespace AutomatedEmails\App\Domain\Conditions\Templates;

use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;

use function AutomatedEmails\Original\Utilities\Collection\_;

class SubjectConditionTemplate implements TemplateDefinition
{
    public function __construct(
        protected PassableCompositeConditionsTemplate $passableCompositeConditionsTemplate
    ) {}
    
    public function definition(): Collection
    {
        return _(
            data: Types::STRING, // template placeholder of a Data. Eg: [post | newPost]
            passableCompositeConditions: $this->passableCompositeConditionsTemplate
                                                      ->definition()
                                                      ->asArray()
        );
    } 
}