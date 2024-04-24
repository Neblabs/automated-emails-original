<?php

return <<<TEMPLATE
<?php

namespace {$namespace};

use {$settings->app->namespace}\App\Components\Abilities\Descriptable;
use {$settings->app->namespace}\App\Components\Abilities\Identifiable;
use {$settings->app->namespace}\App\Components\Abilities\Nameable;
use {$settings->app->namespace}\App\Components\Abilities\Provider;
use {$settings->app->namespace}\App\Components\Abilities\Typeable;
{$postDataTypeComponentImports}
use {$eventNamespace}\\{$eventName};
use {$settings->app->namespace}\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Text\__;
use function AutomatedEmails\Original\Utilities\Collection\_;

class {$className} implements 
    Identifiable, 
    Typeable, 
    Nameable,
    Descriptable,
    Provider
{
    public function identifier(): string
    {
        return '{$eventName}';
    } 

    public function type(): string
    {
        return {$eventName}::class;       
    } 

    public function provides() : Collection
    {
        return _(
            dataTypes: _(
{$postDataTypeImportedClassNameList}
            )
        );
    } 

    public function name(): \Stringable 
    {
        // should be translatable!
        return __('{$eventReadableName}');
    } 

    public function description(): \Stringable 
    {
        //transaltabel too!
        return __('When the status of a posyt has changed');
    }  

    public function gotchas() : Collection
    {
        return _(
            'Ignores: new, inherit and auto-draft statuses',
            "Will run when status is 'draft', you can use the template: Post Status Has Changed Excluding Drafts, or add a Post Status condition."
        );
    } 
}

TEMPLATE;
