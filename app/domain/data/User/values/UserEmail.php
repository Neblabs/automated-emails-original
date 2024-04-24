<?php

namespace AutomatedEmails\App\Domain\Data\User\Values;

use AutomatedEmails\App\Domain\Data\DataForm;
use AutomatedEmails\App\Domain\Data\User\UserValue;

Class UserEmail extends UserValue
{
    public const FORM = DataForm::EMAIL;
    public const ID = 'email';
    
    public function get() : string
    {
        return $this->userData->user()->email();
    }
}