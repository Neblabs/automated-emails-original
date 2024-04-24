<?php

namespace AutomatedEmails\App\Components\Builtin;

use AutomatedEmails\App\Components\Abilities\MultipleComponentsProvider;
use AutomatedEmails\App\Components\Conditions\Builtin\PostCategoriesConditionComponent;
use AutomatedEmails\App\Components\Passable\Builtin\AllMustPassComponent;
use AutomatedEmails\App\Components\Passable\Builtin\HasNonePassableComponent;
use AutomatedEmails\App\Components\Passable\Builtin\OnlyOneMustPassComponent;
use AutomatedEmails\App\Components\Conditions\Builtin\PostStatusConditionComponent;
use AutomatedEmails\App\Components\Conditions\Builtin\UserRoleConditionComponent;
use AutomatedEmails\App\Components\Conditions\Builtin\UserTypeConditionComponent;
use AutomatedEmails\App\Components\Conditions\ConditionComponents;
use AutomatedEmails\App\Components\Data\Builtin\Post\Data\OldPostDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\Post\Data\UpdatedPostDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\Post\PostDataTypeComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\Data\LoggedInUserDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\Data\PostAuthorDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\UserDataTypeComponent;
use AutomatedEmails\App\Components\Data\DataComponents;
use AutomatedEmails\App\Components\Data\DataTypeComponents;
use AutomatedEmails\App\Components\Events\Builtin\PostStatusChangeEvent\Templates\PostPendingComponent;
use AutomatedEmails\App\Components\Events\Builtin\PostStatusChangeEvent\Templates\PostTrashedComponent;
use AutomatedEmails\App\Components\Events\Builtin\PostStatusChangeEventComponent;
use AutomatedEmails\App\Components\Events\BuiltIn\PostUpdated\PostUpdatedComponent;
use AutomatedEmails\App\Components\Events\Builtin\PostUpdated\Templates\PostPublishedUpdatedComponent;
use AutomatedEmails\App\Components\Events\Builtin\Templates\PostPublishedEventTemplateComponent;
use AutomatedEmails\App\Components\Events\EventComponents;
use AutomatedEmails\App\Components\Passable\PassableComponents;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;

class CoreComponents implements 
    MultipleComponentsProvider,
    DataTypeComponents, 
    DataComponents,
    ConditionComponents, 
    EventComponents,
    PassableComponents
{
    public function __construct(
        protected Collection $postStatuses,
        protected Collection $userRoles
    ) {}
    
    public function events() : Collection
    {
        return _(
            /**
             * PostStatusChange
             */
            new PostStatusChangeEventComponent,
            #templates
            new PostPublishedEventTemplateComponent,
            new PostPendingComponent,
            new PostTrashedComponent,
            /**
             * PostUpdated
             */
            new PostUpdatedComponent,
            #templates
            new PostPublishedUpdatedComponent
        );
    }

    public function conditions() : Collection
    {
        return _(
            new PostStatusConditionComponent($this->postStatuses),
            new PostCategoriesConditionComponent,

            new UserRoleConditionComponent($this->userRoles),
            new UserTypeConditionComponent
        );
    }

    public function dataTypes() : Collection
    {
        return _(
            new PostDataTypeComponent,
            new UserDataTypeComponent
        );
    }

    public function data(): Collection
    {
        return _(
            /**
             * Post
             */
            new UpdatedPostDataComponent,
            new OldPostDataComponent,
            /**
             * User
             */
            new PostAuthorDataComponent,
            new LoggedInUserDataComponent,
        );
    } 

    public function passableComposites() : Collection
    {
        return _(
            new AllMustPassComponent,
            new OnlyOneMustPassComponent,
            new HasNonePassableComponent
        );
    }
}