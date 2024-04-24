<?php

namespace AutomatedEmails\App\Components\Data\Builtin\User\Values;

use AutomatedEmails\App\Components\Abilities\Descriptable;
use AutomatedEmails\App\Components\Abilities\Formable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\Data\Forms\TextFormComponent;
use AutomatedEmails\App\Domain\Data\User\Values\UserPublicName;
use function AutomatedEmails\Original\Utilities\Text\__;

class UserPublicNameComponent implements Typeable, Identifiable, Nameable, Descriptable, Formable
{
    public function identifier(): string
    {
        return UserPublicName::ID;
    } 

    public function type(): string
    {
        return UserPublicName::class;
    } 

    public function form(): Identifiable
    {
        return new TextFormComponent;
    } 

    public function name()/*: \Stringable*/ 
    {
        return __('Public Name');
    } 

    public function description()/*: \Stringable*/ 
    {
        return __('The name of the user, as chosen in the "Display name publicly as" profile option.');
    } 
}