<?php

namespace AutomatedEmails\Original\Installation\Executables\Abilities;

use AutomatedEmails\Original\Executable\Abilities\Executable;
use AutomatedEmails\Original\Executable\Abilities\Validatable;
use AutomatedEmails\Original\Validation\Validator;

class ExecutableWithOwnValidation implements Executable, Validatable
{
    public function __construct(
        protected Executable&Validatable $executable
    ) {}
    
    public function canBeExecuted(): Validator
    {
        return $this->executable->canBeExecuted();
    } 

    public function execute()
    {
        if ($this->canBeExecuted()) {
            $this->executable->execute();
        }
    } 
}