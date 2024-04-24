<?php

namespace AutomatedEmails\App\Components\Data\Builtin\Post\Values;

use AutomatedEmails\App\Components\Abilities\Descriptable;
use AutomatedEmails\App\Components\Abilities\Formable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\Data\Forms\NumberFormComponent;
use AutomatedEmails\App\Components\Data\Forms\TextFormComponent;
use AutomatedEmails\App\Domain\Data\Post\Values\PostID;
use AutomatedEmails\App\Domain\Data\Post\Values\PostTitleRaw;
use function AutomatedEmails\Original\Utilities\Text\__;

class PostIDComponent implements Typeable, Identifiable, Nameable, Descriptable, Formable
{
    public function identifier(): string
    {
        return PostID::ID;
    } 

    public function type(): string
    {
        return PostID::class;
    } 

    public function form(): Identifiable
    {
        return new NumberFormComponent;
    } 

    public function name()/*: \Stringable*/  
    {
        return __('ID');
    }

    public function description()/*: \Stringable*/ 
    {
        return __('The database id of the post (number)');
    } 
}