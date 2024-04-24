<?php

namespace AutomatedEmails\Original\Deployment\Processablefiles;

use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Validator;

class PHPFileValidator extends TargetFileValidator
{
    public function execute(): ValidationResult
    {
        return $this->passWhen($this->targetFile->endsWith('.php'));
    } 
}