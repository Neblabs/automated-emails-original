<?php

namespace AutomatedEmails\App\Domain\Events\SupportedData;

use AutomatedEmails\App\Domain\Data\User\UserDataType;
use AutomatedEmails\App\Domain\Data\User\UsersData;

/**
 * Expects a protected posts() method to be implemented
 */
interface Users extends EventDataSet
{
    public function usersData() : UsersData;
    public function usersDataType() : UserDataType;
}