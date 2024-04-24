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
use AutomatedEmails\App\Components\Conditions\Builtin\Options\UserTypeOptionsComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\UserDataTypeComponent;
use AutomatedEmails\App\Domain\Conditions\BuiltIn\UserType\UserType;
use AutomatedEmails\App\Domain\Conditions\BuiltIn\UserType\UserTypeOptions;
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\__;

class UserTypeConditionComponent implements 
    Identifiable,
	Typeable,
    HasRequirements,
	HasOptionsComponent,
	Nameable,
	Descriptable
{
    public function identifier(): string
    {
        return 'UserType';
    } 

    public function type(): string
    {
        return UserType::class;
    } 

    public function requires() : Collection
    {
        return _(
            dataTypes: _(
                UserDataTypeComponent::class
            )
        );
    } 

    public function options() : HasTemplateOptions
    {
        return new UserTypeOptionsComponent;
    }

    public function name()/*: \Stringable*/ 
    {
        return __('Is');
    } 

    public function description()/*: \Stringable*/ 
    {
        return __('Whether the user is a visitor or has an account.');
    } 
}
