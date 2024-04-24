<?php

namespace AutomatedEmails\App\Creation\Values;

use AutomatedEmails\App\Creation\DataValuesFactory;
use AutomatedEmails\App\Domain\Data\DataValue;
use AutomatedEmails\App\Domain\Data\User\UserValues;

class UserValuesFactory extends DataValuesFactory
{
    protected function dataValuesClassName(): string
    {
        return UserValues::class;        
    } 
}