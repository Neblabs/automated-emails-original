<?php

namespace AutomatedEmails\App\Components\Data;

use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Provider;
use AutomatedEmails\App\Components\Abilities\SingularNameable;
use AutomatedEmails\App\Domain\Data\DataType;
use AutomatedEmails\Original\Collections\Collection;
use ReflectionClass;

use function AutomatedEmails\Original\Utilities\Collection\_;

abstract class DataTypeComponent implements Identifiable, Nameable, Provider, SingularNameable
{
    abstract public function dataType() : DataType;
    abstract public function values() : Collection/*<Identifiable&Formable>*/;
    
    abstract protected function nameSpace() : string;
    abstract protected function eventDataSetInterface() : string;
    abstract protected function eventDataSetTrait() : ?string;

    public function identifier(): string
    {
        return ($this->dataType()::class)::ID;
    } 

    public function provides() : Collection
    {
        return _(
            values: $this->dataType()->supportedValues()->map(
                fn($postTitleClass) =>  
                    $this->nameSpace().'\\Values\\'.(new ReflectionClass($postTitleClass))->getShortName().'Component'
            )
        );
    }
}