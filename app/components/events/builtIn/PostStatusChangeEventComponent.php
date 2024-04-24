<?php

namespace AutomatedEmails\App\Components\Events\Builtin;

use AutomatedEmails\App\Components\Abilities\DataTypeable;
use AutomatedEmails\App\Components\Abilities\Descriptable;
use AutomatedEmails\App\Components\Abilities\Groupable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Provider;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\Builtin\Data\Datatypes\Post\PostDataTypeComponent;
use AutomatedEmails\App\Components\ComponentWithDependents;
use AutomatedEmails\App\Components\Data\Builtin\Post\Data\UpdatedPostDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\Post\PostDataTypeComponent as PostPostDataTypeComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\Data\LoggedInUserDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\Data\PostAuthorDataComponent;
use AutomatedEmails\App\Components\Data\DataTypeComponent;
use AutomatedEmails\App\Domain\Data\Post\PostDataType;
use AutomatedEmails\App\Domain\Data\User\UserDataType;
use AutomatedEmails\App\Domain\Events\PostStatusChange\PostStatusChange;
use AutomatedEmails\Original\Collections\Collection;
use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\__;

class PostStatusChangeEventComponent extends ComponentWithDependents implements 
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
        return 'PostStatusChangeEvent';
    } 

    public function type(): string
    {
        return PostStatusChange::class;       
    } 

    public function dataType(): DataTypeComponent
    {
        return new PostPostDataTypeComponent;    
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
        // should be translatable!
        return __('On Post Status Change');
    } 

    public function description()/*: \Stringable*/ 
    {
        //transaltabel too!
        return __('Triggers when the status of a post has changed.');
    }  

    public function gotchas() : Collection
    {
        return _(
            'Ignores: new, inherit and auto-draft statuses',
            "Will run when status is 'draft', you can use the template: Post Status Has Changed Excluding Drafts, or add a Post Status condition."
        );
    } 
}