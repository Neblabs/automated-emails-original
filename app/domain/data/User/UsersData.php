<?php

namespace AutomatedEmails\App\Domain\Data\User;

use AutomatedEmails\App\Creation\Data\UserDataFactory;
use AutomatedEmails\App\Creation\DataFactory;
use AutomatedEmails\App\Domain\Data\DataCollection;
use AutomatedEmails\App\Domain\Data\User\UserData;
use AutomatedEmails\App\Domain\Data\User\UserDataType;

Class UsersData extends DataCollection
{
    public function id(): string
    {
        return UserDataType::ID;        
    }

    protected function getDomainClass() : string
    {
        return UserData::class;
    }

    protected function dataFactory(): DataFactory
    {
        return new UserDataFactory(new UserDataType);
    }  
}