<?php

namespace AutomatedEmails\App\Build\Scripts;

use AutomatedEmails\App\Handlers\DashboardScriptsHandler;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Deployment\Script;
use AutomatedEmails\Original\Environment\Env;
/*
Class ScriptsTranslationPOTSourceLocalizer extends Script
{
    public function run()
    {
        (string) $scriptsPotFileName = Env::directory().Env::settings()->app->translationFiles->scripts;
        (string) $scriptsFileContents = new StringManager(file_get_contents($scriptsPotFileName));
        (object) $assetsData = DashboardScriptsHandler::getAssetsdata();
        (string) $buildFilepath = "app/scripts/dashboard/{$assetsData->get('files')->{'main.js'}}:2";

        var_dump('replacing', );exit('');
        file_put_contents(
            $scriptsPotFileName, 
            i
        );
    }
}*/