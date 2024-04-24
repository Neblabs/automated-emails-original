<?php

namespace AutomatedEmails\Original\Utilities;

use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;

/*******************************************************************************
 *
 *      Validation
 * 
 *******************************************************************************/
/**
 * @throws \Exception
 */
function validate(Validator $validator) : void {
    $validator->validate();
}

/**
 * @throws \Exception
 */
function validateThat(bool $isTrue) : void {
    validate(new ValidWhen($isTrue));
}


