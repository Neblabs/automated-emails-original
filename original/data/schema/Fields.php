<?php

namespace AutomatedEmails\Original\Data\Schema;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Validators\ItemsAreOnlyInstancesOf;
use AutomatedEmails\Original\Data\Schema\Abilities\StructureField;
use AutomatedEmails\Original\Data\Schema\Fields\ID;
use Error;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\validate;

class Fields
{
    public function __construct(
        protected Collection $fields
    ) {
        validate(
            new ItemsAreOnlyInstancesOf($fields, allowedTypes: _(StructureField::class))
        );

        //THROW EXCEPTION FO HAS MORE THEN ONE ID
        //THROW EXCEPTION IF HAS REPEATED KEYS INCLUDING ALIASES
    }

    public function all() : Collection
    {
        return $this->fields;
    }

    public function field(string $name) : StructureField
    {
        return $this->fields->find(
            fn(StructureField $field) => $field->is($name)
        );
    }

    public function has(string $fieldName) : bool
    {
        try {
            $this->field($fieldName);
        } catch (Error) {
            return false;
        }

        return true;
    }

    public function hasId() : bool
    {
        return $this->fields->have($this->findableId());
    }

    public function id() : ID
    {
        return $this->fields->find($this->findableId());
    }

    protected function findableId() : callable
    {
        return fn(StructureField $field) => $field instanceof ID;   
    }
    
}