<?php

namespace AutomatedEmails\App\Domain\Data\User;

use AutomatedEmails\App\Creation\Values\UserValuesFactory;
use AutomatedEmails\App\Creation\DataValuesFactory;
use AutomatedEmails\App\Domain\Data\User\Values\UserTitle;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\App\Domain\Data\DataType;
use AutomatedEmails\App\Domain\Data\User\UserDataType;
use AutomatedEmails\App\Domain\Data\User\UserValues;
use AutomatedEmails\App\Domain\Users\User;

Class UserData extends Data
{
    private User $user;

    protected function setEntity(mixed $entity) : void
    {
        $this->user = $entity;
    }

    public function type(): DataType
    {
        return new UserDataType;  
    } 

    protected function valuesFactory() : UserValuesFactory
    {
        return new UserValuesFactory($this);
    }

    public function user() : User
    {
        return $this->user;
    }

    public function entity() : User
    {
        return $this->user();
    }
}