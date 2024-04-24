<?php

namespace AutomatedEmails\App\Domain\Conditions\Builtin;

use AutomatedEmails\App\Domain\Conditions\Condition;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\FailingValidator;

class Failing extends Condition
{
    static public function id() : string
    {
        return 'Failing';
    }
    
    protected function execute(): Validator
    {
        return new FailingValidator;
    }  

    public function setData(Data $data): void
    {
        //
    } 
}