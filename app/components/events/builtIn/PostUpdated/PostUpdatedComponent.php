<?php

namespace AutomatedEmails\App\Components\Events\BuiltIn\PostUpdated;

use AutomatedEmails\App\Components\Abilities\DataTypeable;
use AutomatedEmails\App\Components\Abilities\Descriptable;
use AutomatedEmails\App\Components\Abilities\Groupable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Provider;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\ComponentWithDependents;
use AutomatedEmails\App\Components\Data\Builtin\Post\Data\OldPostDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\Post\Data\UpdatedPostDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\Post\PostDataTypeComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\Data\LoggedInUserDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\Data\PostAuthorDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\UserDataTypeComponent;
use AutomatedEmails\App\Components\Data\DataTypeComponent;
use AutomatedEmails\App\Domain\Data\Post\PostDataType;
use AutomatedEmails\App\Domain\Data\User\UserDataType;
use AutomatedEmails\App\Domain\Events\Builtin\PostUpdated\PostUpdated;
use AutomatedEmails\Original\Collections\Collection;
use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\__;

class PostUpdatedComponent extends ComponentWithDependents  implements 
    Identifiable, 
    Typeable, 
    Groupable,
    DataTypeable,
    Nameable,
    Descriptable,
    Provider
{
    public function identifier(): string
    {
        return 'PostUpdated';
    } 

    public function type(): string
    {
        return PostUpdated::class;       
    }

    public function dataType(): DataTypeComponent
    {
        return new PostDataTypeComponent;    
    } 

    public function group() : string
    {
        return 'Post';
    }

    public function provides() : Collection
    {
        return _(
            dataTypes: _([
                PostDataType::ID => _(
                    new UpdatedPostDataComponent,
                    new OldPostDataComponent
                ),
                UserDataType::ID => _(
                    new PostAuthorDataComponent,
                    new LoggedInUserDataComponent
                )
            ])
        );
    } 

    public function name()/*: \Stringable*/ 
    {
        return __('Post Has Been Updated');
    } 

    public function description()/*: \Stringable*/ 
    {
        return __('Runs when a post has been updated in the database.');
    }  

    public function gotchas() : Collection
    {
        return _(
            'Because it will run every single time a post has been updated (even by plugins), it is advisable to add conditions specific to your use-case to prevent sending unwanted e-mails',//'Because a post can be updated by many reasons, it is advisable to restr',
            'Ignores: new, inherit and auto-draft statuses',
            "Will run when post has a 'draft' status, you can use the Post Status condition to exclude drafts."
        );
    } 
}
