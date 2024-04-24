<?php

namespace AutomatedEmails\App\Components\Data\Builtin\Post\Data;

use AutomatedEmails\App\Components\Abilities\DataTypeable;
use AutomatedEmails\App\Components\Abilities\Descriptable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Data\Builtin\Post\PostDataTypeComponent;
use AutomatedEmails\App\Components\Data\DataTypeComponent;
use Stringable;

use function AutomatedEmails\Original\Utilities\Text\i;

class UpdatedPostDataComponent implements Identifiable, Nameable, Descriptable, DataTypeable
{
    public const ID = 'UpdatedPost';

    public function identifier(): string
    {
        return static::ID;
    } 

    public function dataType(): DataTypeComponent
    {
        return new PostDataTypeComponent;    
    } 

    public function name()/*: Stringable*/
    {
        return i('Updated Post');
    } 

    public function description()/*: Stringable*/
    {
        return i('The post that has been updated & saved.');
    } 
}
