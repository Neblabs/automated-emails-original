<?php

namespace AutomatedEmails\App\Domain\Data\Abilities\Datasetcolectiongetters;

use AutomatedEmails\App\Domain\Data\Abilities\DataSetColectionGetter;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\App\Domain\Events\Event;

class DataSetCollectionFromEvent implements DataSetColectionGetter
{
    public function __construct(
        protected Event $event
    ) {}
    
    public function dataSetCollection(): DataSetCollection
    {
        return $this->event;
    } 
}