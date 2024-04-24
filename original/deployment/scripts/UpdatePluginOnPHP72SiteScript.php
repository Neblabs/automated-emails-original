<?php

namespace AutomatedEmails\Original\Deployment\Scripts;

use AutomatedEmails\Original\Deployment\Script;
use AutomatedEmails\Original\Environment\Env;
use Symfony\Component\Filesystem\Filesystem;

use function AutomatedEmails\Original\Utilities\Text\i;

Class UpdatePluginOnPHP72SiteScript extends Script
{
    public function run()
    {
        (object) $filesystem = new Filesystem;
        (string) $copyDirectoryName = $this->data->get('copyDirectoryName');
        (object) $copyDirectoryNameRelative = i($copyDirectoryName)->explode('/')->last();
        (string) $mainPluginDirectory = Env::settings()->directories->main;

        print "\nUpdating PHP72 plugin...\n";

        //print  shell_exec("rm -rf /Applications/MAMP/htdocs/php72/wp-content/plugins/automated-emails");

        print shell_exec("cp -R {$copyDirectoryName} /Applications/MAMP/htdocs/php72/wp-content/plugins/");

        $filesystem->rename(
            origin: "/Applications/MAMP/htdocs/php72/wp-content/plugins/{$copyDirectoryNameRelative}",
            target: "/Applications/MAMP/htdocs/php72/wp-content/plugins/{$mainPluginDirectory}",
            overwrite: true
        );
    }
    
}