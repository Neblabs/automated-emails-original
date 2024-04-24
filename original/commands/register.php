<?php

use AutomatedEmails\Original\Commands\BuiltIn\BuildManagerCommand;
use AutomatedEmails\Original\Commands\BuiltIn\CommandCreatorCommand;
use AutomatedEmails\Original\Commands\BuiltIn\CreatorCreatorCommand;
use AutomatedEmails\Original\Commands\BuiltIn\DatabaseManagerCommand;
use AutomatedEmails\Original\Commands\BuiltIn\HandlerCreatorCommand;
use AutomatedEmails\Original\Commands\BuiltIn\ModelCreatorCommand;
use AutomatedEmails\Original\Commands\BuiltIn\TestCreatorCommand;
use AutomatedEmails\Original\Commands\BuiltIn\TaskCreatorCommand;
use AutomatedEmails\Original\Commands\BuiltIn\ValidatorCreatorCommand;
use AutomatedEmails\Original\Commands\BuiltIn\RendererCreatorCommand;
use AutomatedEmails\Original\Commands\BuiltIn\TestCommand;
use AutomatedEmails\Original\Commands\BuiltIn\DomainTestCommandCommand;
use AutomatedEmails\Original\Commands\BuiltIn\TestFilesCommandCommand;
use AutomatedEmails\Original\Commands\BuiltIn\DependencyCreatorCommandCommand;
use AutomatedEmails\Original\Commands\BuiltIn\SubscriberCreatorCommandCommand;

return [
    ModelCreatorCommand::class,
    CreatorCreatorCommand::class,
    HandlerCreatorCommand::class,
    CommandCreatorCommand::class,
    DatabaseManagerCommand::class,
    BuildManagerCommand::class,
    TestCreatorCommand::class,
    TaskCreatorCommand::class,
    ValidatorCreatorCommand::class,
    RendererCreatorCommand::class,
    DomainTestCommandCommand::class,
    TestFilesCommandCommand::class,
    DependencyCreatorCommandCommand::class,
    SubscriberCreatorCommandCommand::class,
];