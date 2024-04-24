<?php

namespace AutomatedEmails\App\Domain\Conditions\BuiltIn\PostCategories;

use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;
use WP_Term;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Collection\a;

class PostCategoriesOptions implements TemplateDefinition
{
    public function definition(): Collection
    {
        return _(
            permission: Types::STRING()->allowed(['allowed', 'forbidden'])->withDefault('allowed'),            
            quantifier: Types::STRING()->allowed(['any', 'all'])->withDefault('any'),
            ids: Types::COLLECTION()->allowed(
                // we'll switch this to ajax, because retreiving all of them categoreis at once is not great for perfomnace when you got a lot of categories, which most sites do
                _(get_categories(a(hide_empty: false)))->map(fn(WP_Term $category) => $category->term_id)
            )
        );
    }
}
