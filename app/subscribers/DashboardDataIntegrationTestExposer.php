<?php

namespace AutomatedEmails\App\Subscribers;

use AutomatedEmails\App\Dashboard\DashboardData;
use AutomatedEmails\Original\Events\Parts\DefaultPriority;
use AutomatedEmails\Original\Events\Parts\EmptyCustomArguments;
use AutomatedEmails\Original\Events\Parts\WillAlwaysExecute;
use AutomatedEmails\Original\Events\Subscriber;

Class DashboardDataIntegrationTestExposer implements Subscriber
{
    use DefaultPriority;
    use EmptyCustomArguments;
    use WillAlwaysExecute;

    public function __construct(
        protected DashboardData $dashboardData
    ) {}
    
    public function execute() : void
    {
        add_filter(hook_name: 'dashboardData', callback: fn() => $this->dashboardData);
    }
} 

