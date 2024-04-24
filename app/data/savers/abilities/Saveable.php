<?php

namespace AutomatedEmails\App\Data\Savers\Abilities;

use AutomatedEmails\Original\Validation\Validator;

interface Saveable
{
    public function canBeSaved(RequestData $data) : Validator;
    public function save(RequestData $data); 
}