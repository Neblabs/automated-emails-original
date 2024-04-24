<?php

namespace AutomatedEmails\App\Components\Data\Builtin\User\Data;

use AutomatedEmails\App\Components\Abilities\DataTypeable;
use AutomatedEmails\App\Components\Abilities\Descriptable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Data\Builtin\User\UserDataTypeComponent;
use AutomatedEmails\App\Components\Data\DataTypeComponent;
use Stringable;
use function AutomatedEmails\Original\Utilities\Text\i;

class PostAuthorDataComponent implements Identifiable, Nameable, Descriptable, DataTypeable
{
    public const ID = 'PostAuthor';

    public function identifier(): string
    {
        return static::ID;
    } 

    public function dataType(): DataTypeComponent
    {
        return new UserDataTypeComponent;    
    } 

    public function name()/*: Stringable*/
    {
        return i('Post Author');
    } 

    public function description()/*: Stringable*/
    {
        return i('The author of the post.');
    } 
}
