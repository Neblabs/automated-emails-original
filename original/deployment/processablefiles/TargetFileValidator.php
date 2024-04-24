<?php

namespace AutomatedEmails\Original\Deployment\Processablefiles;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Validation\Validator;

abstract class TargetFileValidator extends Validator
{
    public function __construct(
        protected StringManager $targetFile
    ) {}
    
    
    protected function getDefaultException() : \Exception
    {
        throw new \Exception('file validation exception');
    }
}