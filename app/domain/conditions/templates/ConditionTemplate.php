<?php

namespace AutomatedEmails\App\Domain\Conditions\Templates;

use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;

use function AutomatedEmails\Original\Utilities\Collection\_;

//decorator
class ConditionTemplate implements TemplateDefinition //extends EntityTemplate
{
    public function __construct(
        protected TemplateDefinition $conditionOptions
    ) {}
    
    public function definition() : Collection
    {
        return _(
            type: Types::STRING,
            options: $this->conditionOptions->definition()->asArray()
        );
    }
}