<?php

namespace AutomatedEmails\App\Creation\Validators;

use AutomatedEmails\App\Data\Savers\Validators\NonceValidator;

class NonceValidatorFactory
{
    public function create(string $nonce, string $action) : NonceValidator
    {
        return new NonceValidator($nonce, $action);
    } 
}