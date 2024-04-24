<?php

namespace AutomatedEmails\App\Subscribers;

use AutomatedEmails\App\Components\AppComponents;
use AutomatedEmails\App\Components\Builtin\CoreComponents;
use AutomatedEmails\App\Components\Builtin\NonImplementedComponents;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Events\Parts\EmptyCustomArguments;
use AutomatedEmails\Original\Events\Parts\PriorityFromProperty;
use AutomatedEmails\Original\Events\Parts\WillAlwaysExecute;
use AutomatedEmails\Original\Events\Subscriber;

Class ComponentsRegistrator implements Subscriber
{
    use PriorityFromProperty,
        WillAlwaysExecute, 
        EmptyCustomArguments;

    protected int $priority = 5;

    public function __construct(
        protected AppComponents $appComponents,
        protected Collection $postStatuses,
        protected Collection $userRoles,
    ) {}
    
    public function execute() : void
    {
        $this->appComponents->register(
            new CoreComponents(
                postStatuses: $this->postStatuses,
                userRoles: $this->userRoles
            )
        );
        $this->appComponents->register(new NonImplementedComponents);
    }
} 