<?php

namespace AutomatedEmails\Original\Events\Parts;

use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;

trait WillAlwaysExecute
{
    public function validator() : Validator
    {
        return new PassingValidator;
    }
}