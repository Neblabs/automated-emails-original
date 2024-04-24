<?php

namespace AutomatedEmails\Original\Collections\Mapper\Types;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Mapper\Types;

Class AnyType extends Types
{
    protected function setType()
    {
        return static::ANY;
    }

    public function isCorrectType($value)
    {
        return true;
    }

    public function hasDefaultValue()
    {
        return false;
    }

    public function concretePickValue($newValue)
    {
        return $newValue;
    }
}