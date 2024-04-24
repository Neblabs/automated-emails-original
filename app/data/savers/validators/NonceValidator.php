<?php

namespace AutomatedEmails\App\Data\Savers\Validators;

use AutomatedEmails\Original\Validation\Exceptions\ValidationException;
use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Validator;
use Exception;

class NonceValidator extends Validator
{
    public function __construct(
        protected string $nonce,
        protected string $action
    ) {}

    public function execute(): ValidationResult
    {
        (integer) $result =  \wp_verify_nonce(
            $this->nonce, 
            $this->action
        );

        return $this->passWhen((boolean) $result);
    } 

    protected function getDefaultException() : Exception
    {
        return new ValidationException('');
    }
}