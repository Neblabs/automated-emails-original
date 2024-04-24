<?php

namespace AutomatedEmails\App\Components\Events\Builtin\PostStatusChangeEvent\Templates;

use AutomatedEmails\App\Components\Abilities\Dependent;
use AutomatedEmails\App\Domain\Events\Builtin\PostStatusChangeEvent\Templates\PostTrashed;

use AutomatedEmails\App\Components\Events\Builtin\PostStatusChangeEventComponent;
use AutomatedEmails\App\Components\Abilities\HasConditionsTemplate;
use AutomatedEmails\Original\Characters\StringManager;
use function AutomatedEmails\Original\Utilities\Text\__;
use function AutomatedEmails\Original\Utilities\Collection\{_, a};

class PostTrashedComponent extends PostStatusChangeEventComponent implements HasConditionsTemplate, Dependent
{
    public function identifier(): string
    {
        return 'PostTrashed';
    } 

    public function type(): string
    {
        return PostTrashed::class;       
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
                                    statuses: ['trash'],
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
        return __('Post Has Been Moved to the Trash');
    } 

    public function description()/*: \Stringable*/ 
    {
        return __("When the status of a post has been set to 'trash'. Not that this is different from being deleted from the database.");
    }  
}