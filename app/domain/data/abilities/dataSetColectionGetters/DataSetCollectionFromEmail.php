<?php

namespace AutomatedEmails\App\Domain\Data\Abilities\Datasetcolectiongetters;

use AutomatedEmails\App\Domain\AutomatedEmails\AutomatedEmail;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetColectionGetter;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;

class DataSetCollectionFromEmail implements DataSetColectionGetter
{
    public function __construct(
        protected AutomatedEmail $automatedEmail
    ) {}
    
    public function dataSetCollection(): DataSetCollection
    {
        return $this->automatedEmail->event();
    } 
}