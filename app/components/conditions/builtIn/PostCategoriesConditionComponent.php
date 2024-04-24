<?php

namespace AutomatedEmails\App\Components\Conditions\Builtin;

use AutomatedEmails\App\Components\Abilities\Descriptable;
use AutomatedEmails\App\Components\Abilities\HasOptionsComponent;
use AutomatedEmails\App\Components\Abilities\HasRequirements;
use AutomatedEmails\App\Components\Abilities\HasTemplateOptions;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\Conditions\Builtin\Options\PostCategoriesOptionsComponent;
use AutomatedEmails\App\Components\Data\Builtin\Post\PostDataTypeComponent;
use AutomatedEmails\App\Domain\Conditions\BuiltIn\PostCategories\PostCategories;
use AutomatedEmails\Original\Collections\Collection;
use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\__;

class PostCategoriesConditionComponent implements 
    Identifiable,
	Typeable,
    HasRequirements,
    HasOptionsComponent,
	Nameable,
	Descriptable
{
    public function identifier(): string
    {
        return 'PostCategories';
    } 

    public function type(): string
    {
        return PostCategories::class;
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
        return new PostCategoriesOptionsComponent;
    }

    public function name()/*: \Stringable*/ 
    {
        return __('Categories');
    } 

    public function description()/*: \Stringable*/ 
    {
        return __("Allow or forbid specific categories.");
    } 
}
