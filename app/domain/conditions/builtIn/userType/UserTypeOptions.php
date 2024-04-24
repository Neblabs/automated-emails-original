<?php

namespace AutomatedEmails\App\Domain\Conditions\BuiltIn\UserType;

use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;

use function AutomatedEmails\Original\Utilities\Collection\_;

class UserTypeOptions implements TemplateDefinition
{
    public function definition(): Collection
    {
        return _(
            type: Types::STRING()->allowed(['account', 'guest'])->withDefault('account'),            
        );
    }
}
