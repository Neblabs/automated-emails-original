<?php

namespace AutomatedEmails\Original\Deployment\Scripts;

use AutomatedEmails\Original\Deployment\Script;
use AutomatedEmails\Original\Environment\Env;

Class PHPDowngradeCompilerScript extends Script
{
    public function run()
    {
        (string) $copyDirectoryName = $this->data->get('copyDirectoryName');
        (string) $command = Env::directory()."vendor/bin/rector process {$copyDirectoryName}";

        print "\nCompiling...\n";
        (string) $outPut = shell_exec($command);

        print $outPut;
    }
    
}