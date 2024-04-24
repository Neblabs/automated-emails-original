<?php

namespace AutomatedEmails\App\Subscribers;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Events\Parts\DefaultPriority;
use AutomatedEmails\Original\Events\Parts\EmptyCustomArguments;
use AutomatedEmails\Original\Events\Parts\WillAlwaysExecute;
use AutomatedEmails\Original\Events\Subscriber;

use function AutomatedEmails\Original\Utilities\Collection\_;

Class DefaultUserRolesRegistrator implements Subscriber
{
    use DefaultPriority;
    use EmptyCustomArguments;
    use WillAlwaysExecute;

    public function __construct(
        protected Collection $userRoles
    ) {}
    
    public function execute() : void
    {
        $this->userRoles->append(
            elements: _(wp_roles()->roles)->map(
                fn(array $roleData, string $roleId) => $roleId
            )->getValues(),
            keepNumericKeys: false
        );
    }
} 

