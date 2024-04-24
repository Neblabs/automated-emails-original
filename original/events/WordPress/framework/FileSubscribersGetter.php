<?php

namespace AutomatedEmails\Original\Events\Wordpress\Framework;

use AutomatedEmails\Original\Abilities\GettableCollection;
use AutomatedEmails\Original\Abilities\ReadableFile;
use AutomatedEmails\Original\Collections\ByFileGettableCollection;
use AutomatedEmails\Original\Collections\Collection;

class FileSubscribersGetter implements GettableCollection
{
    public function __construct(
        protected ReadableFile $source
    ) {}
    
    public function get(): Collection
    {
        (object) $fileGettableCollection = new ByFileGettableCollection(
            $this->source
        );

        return $fileGettableCollection->get();
    } 
}