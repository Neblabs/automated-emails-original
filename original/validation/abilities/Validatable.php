<?php

namespace AutomatedEmails\Original\Validation\Abilities;

use AutomatedEmails\Original\Validation\Validator;

Interface Validatable
{
    public function validate(Validator $validator);
}