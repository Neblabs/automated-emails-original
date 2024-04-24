<?php

return <<<TEMPLATE
<?php

namespace {$namespace};

use {$eventNamespace}\\{$eventName};

use {$baseEventComponentFullyQualifiedClassName};
use {$settings->app->namespace}\App\Components\Abilities\HasConditionsTemplate;
use {$settings->app->namespace}\Original\Characters\StringManager;
use {$settings->app->namespace}\App\Components\Abilities\Dependent;

use function AutomatedEmails\Original\Utilities\Text\__;
use function AutomatedEmails\Original\Utilities\Collection\{_, a};

class {$className} extends {$baseEventComponentClassName} implements HasConditionsTemplate, Dependent
{
    public function identifier(): string
    {
        return '{$eventName}';
    } 

    public function type(): string
    {
        return {$eventName}::class;       
    } 

    public function dependsOn(): string
    {
        return parent::identifier();    
    } 

    public function template(): StringManager
    {
        return _(
            type: 'all',
            subjectConditions: [
                _(
                    data: '[post | UpdatedPost]',
                    passableCompositeConditions: a(
                        type: 'all',
                        conditions: [
                            _(
                                type: 'PostStatus',
                                options: a(
                                    statuses: ['publish'],
                                    isAllowed: true
                                )
                            )->asArray()
                        ]
                    )
                )
            ]
        )->asJson();
    } 
    public function name(): \Stringable 
    {
        return __('{$eventReadableName}');
    } 

    public function description(): \Stringable 
    {
        return __("When the status of a post has been set to 'publish'");
    }  
}
TEMPLATE;
