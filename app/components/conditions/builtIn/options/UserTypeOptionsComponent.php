<?php

namespace AutomatedEmails\App\Components\Conditions\Builtin\Options;

use AutomatedEmails\App\Components\Abilities\HasLabels;
use AutomatedEmails\App\Components\Abilities\HasTemplateOptions;
use AutomatedEmails\App\Components\Abilities\RenderableOptions;
use AutomatedEmails\App\Domain\Conditions\BuiltIn\UserRole\UserRoleOptions;
use AutomatedEmails\App\Domain\Conditions\BuiltIn\UserType\UserTypeOptions;
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Text\__;
use function AutomatedEmails\Original\Utilities\Collection\{_, _a, a, o};

class UserTypeOptionsComponent implements HasTemplateOptions, RenderableOptions, HasLabels
{
    public function __construct(
    ) {}
    
    public function options(): TemplateDefinition
    {
        return new UserTypeOptions;
    }

    public function render() : Collection
    {
        return  _a([
            //each array item is a line
            ['type'],
        ]);

    } 

    public function labels() : Collection 
    {
        return _(
            type: a(
                labels: a(
                ),
                values: fn(Collection $allowedValues) => $allowedValues->map(fn(string $type) => match($type) {
                    'account' => a(
                        type: 'account',
                        name: __('Logged-in'),
                        description: __("The user has an account and it's logged-in")
                    ),
                    'guest' => a(
                        type: 'guest',
                        name: __("A guest with no account"),
                        description: __('The user is a visitor without an account')
                    ),
                })->getValues()
            ),
        );
    } 
}