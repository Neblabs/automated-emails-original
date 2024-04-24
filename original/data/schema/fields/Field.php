<?php

namespace AutomatedEmails\Original\Data\Schema\Fields;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Data\Schema\Abilities\StructureField;

use function AutomatedEmails\Original\Utilities\Text\i;

class Field implements StructureField
{
    protected StringManager $name;
    protected StringManager $alias;

    public function __construct(
        string $name,
        string $alias = ''
    ) {
        $this->name = i($name);
        $this->alias = i($alias);
    }

    public function name(): StringManager
    {
        return $this->name;
    } 

    public function is(string $name): bool
    {
        return $this->name->is($name) || $this->alias->is($name);
    } 
}