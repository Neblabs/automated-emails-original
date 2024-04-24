<?php

namespace AutomatedEmails\Original\Collections;

use AutomatedEmails\Original\Abilities\GettableCollection;

class PassedCollection implements GettableCollection
{
    public function __construct(
        protected Collection $collection
    ) {}
    
    public function get(): Collection
    {
        return $this->collection;
    } 
}