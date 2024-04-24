<?php

namespace AutomatedEmails\Original\Collections;

use AutomatedEmails\Original\Abilities\GettableCollection;

use function AutomatedEmails\Original\Utilities\Collection\_;

class SingleItem implements GettableCollection
{
    public function __construct(
        protected mixed $item
    ) {}
    
    public function get(): Collection
    {
        return _($this->item);
    } 
}