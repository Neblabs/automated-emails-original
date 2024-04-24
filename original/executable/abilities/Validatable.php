<?php

namespace AutomatedEmails\Original\Executable\Abilities;

use AutomatedEmails\Original\Validation\Validator;

interface Validatable
{
    public function canBeExecuted() : Validator;
}