<?php

namespace AutomatedEmails\App\Creation;

use AutomatedEmails\App\Domain\Data\Abilities\FindableData;
use AutomatedEmails\App\Domain\Data\Data;

abstract class DataFactory implements FindableData
{
    abstract public function createNullDataObject() : Data; 
}