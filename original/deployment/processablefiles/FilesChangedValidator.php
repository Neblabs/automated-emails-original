<?php

namespace AutomatedEmails\Original\Deployment\Processablefiles;

use AutomatedEmails\Original\Deployment\Files\Files;
use AutomatedEmails\Original\Executable\Abilities\Validatable;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;

class FilesChangedValidator implements Validatable
{
    public function __construct(
        protected Files $files
    ) {}
    
    public function canBeExecuted(): Validator
    {
        return new ValidWhen($this->files->haveChanged());
    } 
}