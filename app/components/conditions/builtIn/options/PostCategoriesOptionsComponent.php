<?php

namespace AutomatedEmails\App\Components\Conditions\Builtin\Options;

use AutomatedEmails\App\Components\Abilities\HasLabels;
use AutomatedEmails\App\Components\Abilities\HasTemplateOptions;
use AutomatedEmails\App\Components\Abilities\RenderableOptions;
use AutomatedEmails\App\Domain\Conditions\BuiltIn\PostCategories\PostCategoriesOptions;
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use WP_Term;

use function AutomatedEmails\Original\Utilities\Text\__;
use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Collection\_a;
use function AutomatedEmails\Original\Utilities\Collection\a;
use function AutomatedEmails\Original\Utilities\Collection\o;

class PostCategoriesOptionsComponent implements HasTemplateOptions, RenderableOptions, HasLabels
{
    public function __construct(
    ) {}
    
    public function options(): TemplateDefinition
    {
        return new PostCategoriesOptions;
    }

    public function render() : Collection
    {
        return  _a([
            //each array item is a line
            ['permission', 'quantifier'],
            ['ids']
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
                        name: __('Has'),
                        description: __('The post needs to have the categories')
                    ),
                    'forbidden' => a(
                        type: 'forbidden',
                        name: __("Doesn't have"),
                        description: __('The post must not have the categories')
                    ),
                    default => a(
                        type: $permission,
                        name: $permission,
                        description: ''
                    )
                })->getValues()
            ),
            quantifier: a(
                labels: a(
                    right: __('categories')
                ),
                values: fn(Collection $allowedValues) => $allowedValues->map(fn(string $permission) => match($permission) {
                    'any' => a(
                        type: 'any',
                        name: __('Any of these'),
                        description: __('One or more categories')
                    ),
                    'all' => a(
                        type: 'all',
                        name: __("All of these"),
                        description: __('All of the categories')
                    ),
                })->getValues()
            ),
            ids: a(
                labels: a(
                ),
                values: function(Collection $allowedValues) {
                    (object) $allCategories = _(get_categories(a(hide_empty: false)));

                    return $allowedValues->map(function(int $categoryId) use ($allCategories) {
                        /** @var WP_Term */
                        (object) $wp_category = $allCategories->find(
                            fn(WP_Term $category) => $category->term_id === $categoryId
                        ) ?? o();

                        return a(
                            type: $categoryId,
                            name: $wp_category->name,
                            description: $wp_category->description
                        );
                    });   
                }
            ),
        );
    } 
}