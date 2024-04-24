<?php

namespace AutomatedEmails\App\Domain\Data\User\Values;

use AutomatedEmails\App\Domain\Data\DataForm;
use AutomatedEmails\App\Domain\Data\User\UserValue;

Class UserPublicName extends UserValue
{
    public const FORM = DataForm::TEXT;
    public const ID = 'nameDisplay';
    
    public function get() : string
    {
        return $this->userData->user()->publicName();
    }
}