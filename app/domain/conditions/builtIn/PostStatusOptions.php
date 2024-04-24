<?php

namespace AutomatedEmails\App\Domain\Conditions\Builtin;

use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;
use function AutomatedEmails\Original\Utilities\Collection\_;

class PostStatusOptions implements TemplateDefinition
{
    public function __construct(
        protected Collection $postStatuses
    ) {}
    
    public function definition(): Collection
    {
        return _(
            statuses: Types::COLLECTION()->allowed($this->postStatuses)->withDefault(['publish']),
            isAllowed: Types::BOOLEAN()
        );
    }
}