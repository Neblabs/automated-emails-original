<?php

namespace AutomatedEmails\App\Components\Events\Builtin\Templates;

use AutomatedEmails\App\Components\Abilities\Dependent;
use AutomatedEmails\App\Components\Abilities\HasConditionsTemplate;
use AutomatedEmails\App\Components\Events\Builtin\PostStatusChangeEventComponent;
use AutomatedEmails\App\Domain\Events\Poststatuschange\Templates\PostPublished;
use AutomatedEmails\Original\Characters\StringManager;
use function AutomatedEmails\Original\Utilities\Collection\{_, a};
use function AutomatedEmails\Original\Utilities\Text\__;

class PostPublishedEventTemplateComponent extends PostStatusChangeEventComponent implements HasConditionsTemplate, Dependent
{
    public function identifier(): string
    {
        return 'PostPublishedEventTemplate';
    } 

    public function type(): string
    {
        return PostPublished::class;       
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
        return __('Post Has Been Published');
    } 

    public function description()/*: \Stringable*/ 
    {
        return __("When the status of a post has been set to 'publish'");
    }  
}