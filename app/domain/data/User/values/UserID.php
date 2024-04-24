<?php

namespace AutomatedEmails\App\Domain\Data\User\Values;

use AutomatedEmails\App\Domain\Data\DataForm;
use AutomatedEmails\App\Domain\Data\User\UserValue;

Class UserID extends UserValue
{
    public const FORM = DataForm::NUMBER;
    public const ID = 'id';
    
    public function get() : int
    {
        return $this->userData->user()->id();
    }
}