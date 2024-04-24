<?php

namespace AutomatedEmails\App\Domain\Conditions;

use AutomatedEmails\App\Domain\Conditions\Abilities\Passable;
use AutomatedEmails\App\Domain\Data\Abilities\SettableData;
use AutomatedEmails\Original\Domain\Entity;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;

abstract Class Condition extends Entity implements Passable, SettableData
{
    /**
     * The identifier of the condition, for example:
     *      PostStatus
     */
    abstract public static function id() : string;
    abstract protected function execute() : Validator;

    public function passes() : bool
    {
        if ($this->canExecute()->isValid()) {
            return $this->execute()->isValid();
        }

        return false;
    }

    public function fails() : bool
    {
        return !$this->passes();
    }

    protected function canExecute() : Validator
    {
        return new PassingValidator;   
    }
    
}