<?php

namespace AutomatedEmails\Original\Deployment\Scripts;

use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Deployment\Script;

use function AutomatedEmails\Original\Utilities\Text\i;

Class ProductionEnvironmentSetter extends Script
{
    public function run()
    {
        if (i($this->data->target)->endsWith('app/settings/default.php')) {
            (string) $copyDirectoryName = $this->data->get('copyDirectoryName');
            (string) $settingsFile = $this->data->target;

            (object) $prefences = require $settingsFile;
            (string) $productionEnvironment = 'production';

            $prefences->environment = $productionEnvironment;

            file_put_contents($settingsFile, "<?php return ".var_export($prefences, true).";");

            print "\nenvironment changed to {$productionEnvironment}\n";
        }
    }
    
}