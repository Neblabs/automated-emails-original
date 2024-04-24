<?php

namespace AutomatedEmails\Original\Deployment\Processablefiles;

use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Validator;

class NOTVendorFileValidator extends TargetFileValidator
{
    public function execute(): ValidationResult
    {
        return $this->passWhen(!$this->targetFile->matchesRegEx('/automated-emails[\w0-9-_]*\/vendor/'));
    } 
}