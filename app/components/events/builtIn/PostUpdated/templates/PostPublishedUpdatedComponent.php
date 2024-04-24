<?php

namespace AutomatedEmails\App\Components\Events\Builtin\PostUpdated\Templates;

use AutomatedEmails\App\Components\Abilities\Dependent;
use AutomatedEmails\App\Domain\Events\Builtin\PostUpdated\Templates\PostPublishedUpdated;

use AutomatedEmails\App\Components\Events\BuiltIn\PostUpdated\PostUpdatedComponent;
use AutomatedEmails\App\Components\Abilities\HasConditionsTemplate;
use AutomatedEmails\Original\Characters\StringManager;
use function AutomatedEmails\Original\Utilities\Text\__;
use function AutomatedEmails\Original\Utilities\Collection\{_, a};

class PostPublishedUpdatedComponent extends PostUpdatedComponent implements HasConditionsTemplate, Dependent
{
    public function identifier(): string
    {
        return 'PostPublishedUpdated';
    } 

    public function type(): string
    {
        return PostPublishedUpdated::class;       
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
    public function name()/*: \Stringable*/ 
    {
        return __('Published Post Has Been Updated');
    } 

    public function description()/*: \Stringable*/ 
    {
        return __("When an existing published post (with the 'publish' status) has been updated.");
    }  
}