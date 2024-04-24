<?php

namespace AutomatedEmails\App\Components\Data\Builtin\User;

use AutomatedEmails\App\Components\Data\Builtin\User\Values\UserEmailComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\Values\UserIDComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\Values\UserPublicNameComponent;
use AutomatedEmails\App\Components\Data\DataTypeComponent;
use AutomatedEmails\App\Domain\Data\User\UserDataType;
use AutomatedEmails\App\Domain\Events\SupportedData\Users;
use AutomatedEmails\App\Domain\Events\Supporteddata\GetUsers;
use AutomatedEmails\Original\Collections\Collection;
use Stringable;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\__;

class UserDataTypeComponent extends DataTypeComponent
{
    public function dataType() : UserDataType
    {
        return new UserDataType;
    }

    public function values(): Collection
    {
        return _(
            new UserPublicNameComponent,
            new UserEmailComponent,
            new UserIDComponent
        );
    } 

    public function name()/*: \Stringable*/ 
    {
        return __('Users');
    } 

    public function nameSingular()/*: Stringable*/
    {
        return __('User');    
    } 

    public function eventDataSetInterface() : string
    {
        return Users::class;
    }

    public function eventDataSetTrait() : ?string
    {
        return GetUsers::class;
    }

    protected function nameSpace(): string
    {
        return __NAMESPACE__;
    } 
}
