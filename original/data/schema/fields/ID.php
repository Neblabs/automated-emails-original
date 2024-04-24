<?php

namespace AutomatedEmails\Original\Data\Schema\Fields;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Data\Schema\Abilities\StructureField;

use function AutomatedEmails\Original\Utilities\Text\i;

class ID implements StructureField
{
    public function __construct(
        protected StructureField $field,
        protected string $name
    ) {}

    public function name(): StringManager
    {
        return $this->field->name();    
    } 

    public function is(string $name): bool
    {
        return $this->field->is($name);
    } 

    public function id() : StringManager
    {
        return i($this->name);
    }
}