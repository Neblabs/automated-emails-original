<?php

namespace AutomatedEmails\App\Domain\Conditions\BuiltIn\UserRole;

use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;

use function AutomatedEmails\Original\Utilities\Collection\_;

class UserRoleOptions implements TemplateDefinition
{
    public function __construct(
        protected Collection $userRoles
    ) {}
    
    public function definition(): Collection
    {
        return _(
            permission: Types::STRING()->allowed(['allowed', 'forbidden'])->withDefault('allowed'),            
            quantifier: Types::STRING()->allowed(['any', 'all'])->withDefault('any'),
            ids: Types::COLLECTION()->allowed($this->userRoles)
        );
    }
}
