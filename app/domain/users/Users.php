<?php

namespace AutomatedEmails\App\Domain\Users;

use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\App\Domain\Users\Users;

Class Users extends Entities
{
    protected function getDomainClass() : string
    {
        return User::class;
    }
}