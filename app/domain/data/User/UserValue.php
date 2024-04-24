<?php

namespace AutomatedEmails\App\Domain\Data\User;

use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\App\Domain\Data\User\UserData;
use AutomatedEmails\App\Domain\Data\DataValue;
use AutomatedEmails\Original\System\Functions\GlobalFunctionWrapper;
use WP_User;

Abstract Class UserValue extends DataValue
{
    public function __construct(
        protected UserData $userData,
    ) {}

    public function data(): Data
    {
        return $this->userData;
    }

    protected function classicUser() : WP_User
    {
        return $this->userData->user()->classic();   
    }
}