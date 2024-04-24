<?php

namespace AutomatedEmails\App\Presentation\Components\Dashboarddevelopmentscripts;

use AutomatedEmails\Original\Presentation\Component;

Class DashboardDevelopmentScripts extends Component
{
    protected $file = 'dashboardDevelopmentScriptsView.php';
    public string $dashboardID;  

    public function __construct($dashboardID)
    {
        $this->dashboardID = $dashboardID;   
    }
    
}