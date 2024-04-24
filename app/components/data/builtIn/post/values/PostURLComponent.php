<?php

namespace AutomatedEmails\App\Components\Data\Builtin\Post\Values;

use AutomatedEmails\App\Components\Abilities\Descriptable;
use AutomatedEmails\App\Components\Abilities\Formable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\Data\Forms\TextFormComponent;
use AutomatedEmails\App\Components\Data\Forms\URLFormComponent;
use AutomatedEmails\App\Domain\Data\Post\Values\PostURL;
use function AutomatedEmails\Original\Utilities\Text\__;

class PostURLComponent implements Typeable, Identifiable, Nameable, Descriptable, Formable
{
    public function identifier(): string
    {
        return PostURL::ID;
    } 

    public function type(): string
    {
        return PostURL::class;
    } 

    public function form(): Identifiable
    {
        return new URLFormComponent;
    } 

    public function name()/*: \Stringable*/  
    {
        return __('URL');
    }

    public function description()/*: \Stringable*/ 
    {
        return __('The URL of the post, unclickable.');
    } 
}