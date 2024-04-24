<?php

namespace AutomatedEmails\Original\Collections;

use AutomatedEmails\Original\Abilities\GettableCollection;
use AutomatedEmails\Original\Collections\Collection;

/**
 * Though not obvious at first, this class
 * allows you to merge an infinite number of collections
 */
class GettableCollectionDecorator implements GettableCollection
{
    public function __construct(
        protected GettableCollection $parentGettableCollection,
        protected GettableCollection $childGettableCollection
    ) {}

    public function get(): Collection
    {
        return $this->parentGettableCollection->get()->append(
            $this->childGettableCollection->get()
        );
    } 
}