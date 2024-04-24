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
use AutomatedEmails\App\Components\Conditions\Builtin\Options\UserRoleOptionsComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\UserDataTypeComponent;
use AutomatedEmails\App\Domain\Conditions\BuiltIn\UserRole\UserRole;
use AutomatedEmails\App\Domain\Conditions\BuiltIn\UserRole\UserRoleOptions;
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\__;

class UserRoleConditionComponent implements 
    Identifiable,
	Typeable,
    HasRequirements,
    HasOptionsComponent,
	Nameable,
	Descriptable
{
    public function __construct(
        protected Collection $userRoles
    ) {}
    
    public function identifier(): string
    {
        return 'UserRole';
    } 

    public function type(): string
    {
        return UserRole::class;
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
        return new UserRoleOptionsComponent($this->userRoles);
    }

    public function name()/*: \Stringable*/ 
    {
        return __('Roles');
    } 

    public function description()/*: \Stringable*/ 
    {
        return __("Allow or forbid specific roles");
    } 
}
