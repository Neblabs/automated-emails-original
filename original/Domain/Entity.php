<?php

namespace AutomatedEmails\Original\Domain;

use AutomatedEmails\Original\Validation\Abilities\Validatable;
use AutomatedEmails\Original\Validation\Validator;

Abstract Class Entity implements Validatable
{
    public function validate(Validator $validator)
    {
        $validator->validate();
    }
}