<?php

namespace AutomatedEmails\App\Components\Conditions\Builtin\Options;

use AutomatedEmails\App\Components\Abilities\HasLabels;
use AutomatedEmails\App\Components\Abilities\HasTemplateOptions;
use AutomatedEmails\App\Components\Abilities\RenderableOptions;
use AutomatedEmails\App\Domain\Conditions\BuiltIn\PostCategories\PostCategoriesOptions;
use AutomatedEmails\App\Domain\Conditions\BuiltIn\UserRole\UserRoleOptions;
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use WP_Term;

use function AutomatedEmails\Original\Utilities\Text\__;
use function AutomatedEmails\Original\Utilities\Collection\{_, a, _a, o};

class UserRoleOptionsComponent implements HasTemplateOptions, RenderableOptions, HasLabels
{
    public function __construct(
        protected Collection $userRoles
    ) {}
    
    public function options(): TemplateDefinition
    {
        return new UserRoleOptions($this->userRoles);
    }

    public function render() : Collection
    {
        return  _a([
            //each array item is a line
            ['permission',],
            ['quantifier', 'ids']
            //['excludeThese']
        ]);
    } 

    public function labels() : Collection 
    {
        return _(
            permission: a(
                labels: a(
                ),
                values: fn(Collection $allowedValues) => $allowedValues->map(fn(string $permission) => match($permission) {
                    'allowed' => a(
                        type: 'allowed',
                        name: __('Contain'),
                        description: __("The user needs to have the roles")
                    ),
                    'forbidden' => a(
                        type: 'forbidden',
                        name: __("Doesn't contain"),
                        description: __('The user must not have the roles')
                    ),
                })->getValues()
            ),
            quantifier: a(
                labels: a(
                    right: __('roles: ')
                ),
                values: fn(Collection $allowedValues) => $allowedValues->map(fn(string $permission) => match($permission) {
                    'any' => a(
                        type: 'any',
                        name: __('Any of these'),
                        description: __('One or more roles')
                    ),
                    'all' => a(
                        type: 'all',
                        name: __("All of these"),
                        description: __('All the roles')
                    ),
                })->getValues()
            ),
            ids: a(
                labels: a(
                ),
                values: function(Collection $allowedValues) {
                    (object) $allRoles = _(wp_roles()->roles);

                    return $allowedValues->map(function(string $currentRoleId) use ($allRoles) {
                        (object) $role = $allRoles->find(
                            fn(array $roleData, string $roleId) => $roleId === $currentRoleId
                        ) ?? [];

                        return a(
                            type: $currentRoleId,
                            name: $role['name'],
                            description: ''
                        );
                    })->getValues();   
                }
            ),
        );
    } 
}