<?php

namespace AutomatedEmails\App\Components\Data\Builtin\Post\Values;

use AutomatedEmails\App\Components\Abilities\Descriptable;
use AutomatedEmails\App\Components\Abilities\Formable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\Data\Forms\TextFormComponent;
use AutomatedEmails\App\Domain\Data\Post\Values\PostTitle;

use function AutomatedEmails\Original\Utilities\Text\__;

class PostTitleComponent implements Typeable, Identifiable, Nameable, Descriptable, Formable
{
    public function identifier(): string
    {
        return PostTitle::ID;
    } 

    public function type(): string
    {
        return PostTitle::class;
    } 

    public function form(): Identifiable
    {
        return new TextFormComponent;
    } 

    public function name()/*: \Stringable*/  
    {
        return __('Title');
    }

    public function description()/*: \Stringable*/ 
    {
        return __('The title of the post, with filters applied');
    } 
}