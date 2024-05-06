<?php

namespace AutomatedEmails\Original\Construction;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Abilities\Overloadable;

class FactoryOverloaderFromClassStrings implements Overloadable
{
    public function __construct(
        protected Collection $factoryOverloaderClasses
    ) {}
    
    public function overload(mixed $value): mixed
    {
               
    } 
}