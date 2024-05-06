<?php

namespace AutomatedEmails\Original\Events\Handler\BuiltIn;

use AutomatedEmails\App\Installators\AppInstallation;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Events\Handler\EventHandler;

Class OriginalInstallatorHandler extends EventHandler
{
    protected $numberOfArguments = 1;
    protected $priority = 10;

    public function execute()
    {
        //(object) $installator = new AppInstallation;
    }
}