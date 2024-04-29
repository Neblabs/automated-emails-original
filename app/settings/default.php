<?php

use AutomatedEmails\App\Data\Schema\ApplicationDatabase;
use AutomatedEmails\App\Events\CustomGlobalEventsValidator;

use function AutomatedEmails\Original\Utilities\Collection\o;

return o(
    app: o(
        id: 'automatedemails',
        shortId: 'ae',
        namespace: 'AutomatedEmails',
        pluginFileName: 'automated-emails',
        textDomain: 'automated-emails',
        translationFiles: o(
            production: 'international/automated-emails-international.pot',
            main: 'international/main-source.pot',
            scripts: 'international/scripts-source.pot'
        )
    ),
    events: o(
        globalValidator: CustomGlobalEventsValidator::class
    ),
    schema: o(
        applicationDatabase: ApplicationDatabase::class
    ),
    directories: o(
        main: 'automated-emails',
        app: o(
            schema: 'data/schema',
            scripts: 'scripts',
            dashboard: 'scripts/dashboard',
        ),
        development: o(
            repository: '/Applications/MAMP/Repository/AutomatedEmails'
        ),
        storage: o(
            branding: 'storage/branding'
        )
    ),
    environment: 'development',
    binaries: o(
        php: '/opt/local/bin/php72',
        phpunit: './vendor/bin/phpunit'
    )
);