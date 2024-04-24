<?php

namespace AutomatedEmails\App\Data\Savers\Abilities;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Validation\Validator;

interface KeyValueSaveableDataProvider
{
    public function inputKey() : string; 
    public function outputKey() : string;

    public function canBeSaved(StringManager $dataToSave) : Validator; 
    public function dataToSave(StringManager $dataToSave) : Collection|string|int|float;
}