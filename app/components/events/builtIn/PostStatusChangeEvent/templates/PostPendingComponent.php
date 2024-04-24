<?php

namespace AutomatedEmails\App\Components\Events\Builtin\PostStatusChangeEvent\Templates;

use AutomatedEmails\App\Components\Abilities\Dependent;
use AutomatedEmails\App\Domain\Events\Builtin\PostStatusChangeEvent\Templates\PostPending;

use AutomatedEmails\App\Components\Events\Builtin\PostStatusChangeEventComponent;
use AutomatedEmails\App\Components\Abilities\HasConditionsTemplate;
use AutomatedEmails\Original\Characters\StringManager;
use function AutomatedEmails\Original\Utilities\Text\__;
use function AutomatedEmails\Original\Utilities\Collection\{_, a};

class PostPendingComponent extends PostStatusChangeEventComponent implements HasConditionsTemplate, Dependent
{
    public function identifier(): string
    {
        return 'PostPending';
    } 

    public function type(): string
    {
        return PostPending::class;       
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
                                    statuses: ['pending'],
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
        return __('Published Has Been Submitted for Review');
    } 

    public function description()/*: \Stringable*/ 
    {
        return __("When the status of a post has been set to 'pending'.");
    }  
}