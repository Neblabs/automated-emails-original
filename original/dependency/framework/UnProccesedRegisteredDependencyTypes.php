<?php

namespace AutomatedEmails\Original\Dependency\Framework;

use AutomatedEmails\Original\Abilities\GettableCollection;
use AutomatedEmails\Original\Collections\ByFileGettableCollection;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\GettableCollectionDecorator;

class UnProccesedRegisteredDependencyTypes implements GettableCollection
{
    public function get(): Collection
    {
        (object) $registeredTypes = new GettableCollectionDecorator(
            new ByFileGettableCollection(
                new OriginalDependencyTypes
            ),
            new ByFileGettableCollection(
                new AppDependencyTypes
            )
        );

        return $registeredTypes->get();
    } 
}