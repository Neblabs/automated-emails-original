<?php

namespace AutomatedEmails\App\Components\Data\Builtin\User\Values;

use AutomatedEmails\App\Components\Abilities\Descriptable;
use AutomatedEmails\App\Components\Abilities\Formable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\Data\Forms\EmailFormComponent;
use AutomatedEmails\App\Components\Data\Forms\TextFormComponent;
use AutomatedEmails\App\Domain\Data\User\Values\UserEmail;

use function AutomatedEmails\Original\Utilities\Text\__;

class UserEmailComponent implements Typeable, Identifiable, Nameable, Descriptable, Formable
{
    public function identifier(): string
    {
        return UserEmail::ID;
    } 

    public function type(): string
    {
        return UserEmail::class;
    } 

    public function form(): Identifiable
    {
        return new EmailFormComponent;
    } 

    public function name()/*: \Stringable*/ 
    {
        return __('E-mail');
    } 

    public function description()/*: \Stringable*/ 
    {
        return __('The e-mail of the user.');
    } 
}