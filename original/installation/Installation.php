<?php

namespace AutomatedEmails\Original\Installation;

use AutomatedEmails\App\Installators\ConcreteInstallator;
use AutomatedEmails\Original\Environment\Env;

Abstract Class Installation
{
    /**
     * Runs only once after it's been installed and activated.
     * Runs before static::activate();
     */
    abstract public function install();
    abstract public function activate();
    abstract public function deactivate();

    public function __construct()
    {
        $this->registerInstallation();
        $this->registerActivation();
        $this->registerDeactivation();
    }

    protected function registerInstallation()
    {
        (object) $installEvent = new InstallEvent($this);

        $installEvent->runOnce();
    }

    protected function registerActivation()
    {
        register_activation_hook(
            Env::absolutePluginFilePath(), 
            [$this, 'activate']
        );
    }

    protected function registerDeactivation()
    {
        register_deactivation_hook(
            Env::absolutePluginFilePath(), 
            [$this, 'deactivate']
        );
    }
}