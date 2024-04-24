<?php

namespace AutomatedEmails\Original\Abilities;

use Attribute;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;

#[Attribute]
class Methods
{
    public function __construct(
        protected array $names
    ) {}

    public function names() : Collection
    {
        return _($this->names);
    }
}