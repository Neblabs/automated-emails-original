<?php

use AutomatedEmails\Original\Events\Handler\BuiltIn\OriginalInstallatorHandler;
use AutomatedEmails\Original\Events\Handler\BuiltIn\OriginalShortCodesRegistratorHandler;

return [
    'init' => [
        OriginalShortCodesRegistratorHandler::class
    ],
    '__(shortId).loaded__' => [
        OriginalInstallatorHandler::class
    ]
];