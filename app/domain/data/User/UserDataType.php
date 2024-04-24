<?php

namespace AutomatedEmails\App\Domain\Data\User;

use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\Data\Builtin\User\UserDataTypeComponent;
use AutomatedEmails\App\Domain\Data\DataType;
use AutomatedEmails\Original\Collections\Collection;

class UserDataType extends DataType
{
    public const ID = 'user';
    
    public function id() : string
    {
        return static::ID;
    }

    public function supportedValues() : Collection
    {
        return (new UserDataTypeComponent)->values()->map(
            fn(Typeable $valueComponent) => $valueComponent->type()
        );
    }
}