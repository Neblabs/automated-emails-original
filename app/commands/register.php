<?php

use AutomatedEmails\App\Commands\NewCreatorCommand;
use AutomatedEmails\App\Commands\TestAndDataSetCreatorCommand;
use AutomatedEmails\App\Commands\QuickConsolePlaygroundCommand;
use AutomatedEmails\App\Commands\ComponentsCreatorCommand;
use AutomatedEmails\App\Commands\PassableCreatorCommand;
use AutomatedEmails\App\Commands\EventComponentCreatorCommand;
use AutomatedEmails\App\Commands\ConditionComponentCreatorCommand;
use AutomatedEmails\App\Commands\DataComponentCreatorCommand;
use AutomatedEmails\App\Commands\EventCreatorCommand;
use AutomatedEmails\App\Commands\EventTemplateCreatorCommand;

return [
    TestAndDataSetCreatorCommand::class,
    NewCreatorCommand::class,
    QuickConsolePlaygroundCommand::class,
    ComponentsCreatorCommand::class,
    PassableCreatorCommand::class,
    EventComponentCreatorCommand::class,
    ConditionComponentCreatorCommand::class,
    DataComponentCreatorCommand::class,
    EventCreatorCommand::class,
    EventTemplateCreatorCommand::class,
];