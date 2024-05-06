<?php

namespace AutomatedEmails\Original\Construction\Objects;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Abilities\Creatable;

class ObjectsFromClassStringsFactory implements Creatable
{
    public function __construct(
        protected Collection $classStrings
    ) {}
    
    public function create() : object
    {
        return $this->classStrings->map(fn(string $className) => new $className);
    } 
}