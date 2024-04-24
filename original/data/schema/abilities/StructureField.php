<?php

namespace AutomatedEmails\Original\Data\Schema\Abilities;

use AutomatedEmails\Original\Characters\StringManager;

interface StructureField
{
    public function name() : StringManager;
    public function is(string $name) : bool;
}