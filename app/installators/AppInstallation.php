<?php

namespace AutomatedEmails\App\Installators;

use AutomatedEmails\App\Data\Settings\Settings;
use AutomatedEmails\Original\Data\Drivers\WordPressDatabaseDriver;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Installation\Installation;
use AutomatedEmails\Original\Installation\Installator;

Class AppInstallation extends Installation
{
    protected $applicationDatabase;

    public function __construct()
    {
        (string) $ApplicationDatabase = Env::settings()->schema->applicationDatabase;

        $this->applicationDatabase = new $ApplicationDatabase(new WordPressDatabaseDriver);   

        parent::__construct();
    }

    public function install()
    {
        // Nothing yet...
    }

    public function activate()
    {
        //$this->applicationDatabase->install();
    }

    public function deactivate()
    {
        // Nothing yet...
    }
}