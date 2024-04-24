<?php

namespace AutomatedEmails\Original\Events\Wordpress\Framework;

use AutomatedEmails\Original\Abilities\GettableCollection;
use AutomatedEmails\Original\Collections\ByFileGettableCollection;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\GettableCollectionDecorator;

class RegisteredSubscribers implements GettableCollection
{
    public function __construct(
        protected FileSubscribersGetter $originalSubscribersGetter,
        protected FileSubscribersGetter $appSubscribersGetter
    ) {}
    
    public function get(): Collection
    {
        (object) $originalSubscribers = $this->originalSubscribersGetter->get();
        (object) $appSubscribers = $this->appSubscribersGetter->get();

        return $originalSubscribers->ungroup()
                                   ->append($appSubscribers->ungroup())
                                   ->group();
    } 
}