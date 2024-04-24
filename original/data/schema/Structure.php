<?php

namespace AutomatedEmails\Original\Data\Schema;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Data\Schema\Abilities\StructureIdentifier;

abstract class Structure
{
    abstract public function name() : string;
    abstract public function fields() : Fields;
}