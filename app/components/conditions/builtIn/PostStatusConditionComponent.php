<?php

namespace AutomatedEmails\App\Components\Conditions\Builtin;

use AutomatedEmails\App\Components\Abilities\Descriptable;
use AutomatedEmails\App\Components\Abilities\HasOptionsComponent;
use AutomatedEmails\App\Components\Abilities\HasRequirements;
use AutomatedEmails\App\Components\Abilities\HasTemplateOptions;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\Conditions\Builtin\Options\PostStatusOptionsComponent;
use AutomatedEmails\App\Components\Data\Builtin\Post\PostDataTypeComponent;
use AutomatedEmails\App\Domain\Conditions\BuiltIn\PostStatus;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Text\__;
use function AutomatedEmails\Original\Utilities\Collection\_;

class PostStatusConditionComponent implements 
    Identifiable, 
    Typeable, 
    HasRequirements,
    Nameable, 
    HasOptionsComponent,
    Descriptable
{
    public function __construct(
        protected Collection $postStatuses
    ) {}
    
    public function identifier(): string
    {
        return 'PostStatus';
    } 

    public function type(): string
    {
        return PostStatus::class;
    } 

    public function requires() : Collection
    {
        return _(
            dataTypes: _(
                PostDataTypeComponent::class
            )
        );
    } 

    public function options() : HasTemplateOptions
    {
        return new PostStatusOptionsComponent($this->postStatuses);
    }

    public function name()/*: \Stringable*/ 
    {
        return __('Status');
    } 

    public function description()/*: \Stringable*/ 
    {
        return __('Allow or forbid specific post statuses');
    } 
}