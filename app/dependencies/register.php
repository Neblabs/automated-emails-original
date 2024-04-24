<?php

use AutomatedEmails\App\Components\Exporters\Dashboard\DashboardComponentsExporter;
use AutomatedEmails\App\Dependencies\AppComponentsDependency;
use AutomatedEmails\App\Dependencies\AutomatedEmailsFinderDependency;
use AutomatedEmails\App\Dependencies\AutomatedEmailsFinderFactoryDependency;
use AutomatedEmails\App\Dependencies\AutomatedEmailsPostQueryParametersDependency;
use AutomatedEmails\App\Dependencies\AutomatedEmailsStructureDependency;
use AutomatedEmails\App\Dependencies\ComponentsDependency;
use AutomatedEmails\App\Dependencies\ComponentsExporterDependency;
use AutomatedEmails\App\Dependencies\ConditionsRootSQLParametersDependency;
use AutomatedEmails\App\Dependencies\DashboardComponentsExporterDependency;
use AutomatedEmails\App\Dependencies\DashboardDataDependency;
use AutomatedEmails\App\Dependencies\EmailsSenderDependency;
use AutomatedEmails\App\Dependencies\EventStructureDependency;
use AutomatedEmails\App\Dependencies\EventToAutomatedEmailsFactoryDependency;
use AutomatedEmails\App\Dependencies\EventsDependency;
use AutomatedEmails\App\Dependencies\EventsFinderDependency;
use AutomatedEmails\App\Dependencies\EventsSQLParametersDependency;
use AutomatedEmails\App\Dependencies\PassableCompositeConditionsMapperDependency;
use AutomatedEmails\App\Dependencies\PostStatusesDependency;
use AutomatedEmails\App\Dependencies\RecipientSQLParametersDependency;
use AutomatedEmails\App\Dependencies\TemplateFactoryDependency;
use AutomatedEmails\App\Dependencies\WPDBDependency;
use AutomatedEmails\App\Dependencies\WordPressDatabaseReadableDriverDependency;
use AutomatedEmails\App\Dependencies\WordPressPostArrayReadableDriverDependency;
use AutomatedEmails\App\Dependencies\UserRolesDependency;
use AutomatedEmails\App\Dependencies\WordPressPostSaverDependency;
use AutomatedEmails\App\Dependencies\AutomatedEmailsPostTypeIdDependency;
use AutomatedEmails\App\Dependencies\StateExporterDependency;

return [
    // here the magic will happen!,
    AppComponentsDependency::class,
    ComponentsDependency::class,
    EventsFinderDependency::class,
    EventsDependency::class,
    WPDBDependency::class,
    WordPressDatabaseReadableDriverDependency::class,
    EventStructureDependency::class,
    PassableCompositeConditionsMapperDependency::class,
    AutomatedEmailsFinderFactoryDependency::class,
    AutomatedEmailsStructureDependency::class,
    AutomatedEmailsPostQueryParametersDependency::class,
    EventToAutomatedEmailsFactoryDependency::class,
    AutomatedEmailsFinderDependency::class,
    ConditionsRootSQLParametersDependency::class,
    WordPressPostArrayReadableDriverDependency::class,
    RecipientSQLParametersDependency::class,
    TemplateFactoryDependency::class,
    EmailsSenderDependency::class,
    EventsSQLParametersDependency::class,
    DashboardDataDependency::class,
    PostStatusesDependency::class,
    DashboardComponentsExporterDependency::class,
    UserRolesDependency::class,
    WordPressPostSaverDependency::class,
    AutomatedEmailsPostTypeIdDependency::class,
    StateExporterDependency::class,
];