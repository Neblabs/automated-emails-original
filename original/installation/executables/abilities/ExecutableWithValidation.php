<?php

namespace AutomatedEmails\Original\Installation\Executables\Abilities;

use AutomatedEmails\Original\Executable\Abilities\Executable;
use AutomatedEmails\Original\Executable\Abilities\Validatable;
use AutomatedEmails\Original\Validation\Validator;

class ExecutableWithValidation implements Executable, Validatable
{
    public function __construct(
        protected Executable $executable,
        protected Validatable $validator
    ) {}
    
    public function canBeExecuted(): Validator
    {
        return $this->validator->canBeExecuted();
    } 

    public function execute()
    {
        if ($this->canBeExecuted()) {
            $this->executable->execute();
        }
    } 
}