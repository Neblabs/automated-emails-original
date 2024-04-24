<?php

namespace AutomatedEmails\App\Domain\Data\User;

use AutomatedEmails\App\Domain\Data\DataValues;
use AutomatedEmails\App\Domain\Data\User\UserValue;

Class UserValues extends DataValues
{
    protected function getDomainClass() : string
    {
        return UserValue::class;
    }
}