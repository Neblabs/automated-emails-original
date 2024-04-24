<?php

namespace AutomatedEmails\App\Domain\Events\Supporteddata;

use AutomatedEmails\App\Domain\Data\User\UserDataType;
use AutomatedEmails\App\Domain\Data\User\UsersData;

trait GetUsers
{
    public function usersData() : UsersData
    {
        return $this->dataSet($this->usersDataType()->id());
    }

    public function usersDataType() : UserDataType
    {
        return new UserDataType;
    }
}