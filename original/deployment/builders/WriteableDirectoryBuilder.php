<?php

namespace AutomatedEmails\Original\Deployment\Builders;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Deployment\Directories\Directories;
use AutomatedEmails\Original\Executable\Abilities\Executable;
use AutomatedEmails\Original\Executable\Abilities\Validatable;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;

class WriteableDirectoryBuilder implements Executable, Validatable
{
    public function __construct(
        protected StringManager $target,
        protected bool $override = false
    ) {}

    public function canBeExecuted(): Validator
    {
        return new ValidWhen($this->override === false && is_dir($this->target));
    }     

    public function execute()
    {
        mkdir(
            directory: dd($this->target, 'making!'),
            recursive: true
        );
    } 
}