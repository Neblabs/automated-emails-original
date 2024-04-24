<?php

namespace AutomatedEmails\App\Subscribers;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Events\Parts\DefaultPriority;
use AutomatedEmails\Original\Events\Parts\EmptyCustomArguments;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\Wordpress\EventArguments;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;

use function AutomatedEmails\Original\Utilities\Collection\_;

Class DefaultPostStatusesRegistrator implements Subscriber
{
    use DefaultPriority;
    use EmptyCustomArguments;

    public function __construct(
        protected Collection $postStatuses
    ) {}
    
    public function validator() : Validator
    {
        return new PassingValidator;
    }

    public function execute() : void
    {
        (object) $ignoredStatuses = _('new', 'inherit', 'auto-draft');
        
        $this->postStatuses->append(
            elements: _(get_post_stati(output: 'objects'))->filter(
                fn(object $postStatusData, string $postStatus) => 
                    $ignoredStatuses->doesNotHave($postStatus) && 
                    $postStatusData->_builtin
            )->map(fn(object $postStatusData, string $postStatus) => $postStatus),
            keepNumericKeys: false
        );
    }
} 

