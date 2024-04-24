<?php

namespace AutomatedEmails\App\Build\Scripts;

use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Deployment\Script;

Class WebpackProductionBuilderScript extends Script
{
    public function run()
    {
        system('cd /Applications/MAMP/htdocs/coupons-plus/wp-content/plugins/coupons-plus/app/scripts/dashboard && npm run build | gnomon');
   }
    
}