<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Components\Exporters\Dashboard\ComponentsExporter;
use AutomatedEmails\App\Components\Exporters\Dashboard\DashboardComponentsExporter;
use AutomatedEmails\App\Components\Exporters\Dashboard\FieldsToSaveExporter;
use AutomatedEmails\App\Components\Exporters\Dashboard\NoncesExporter;
use AutomatedEmails\App\Components\Exporters\Dashboard\StateExporter;
use AutomatedEmails\App\Components\Exporters\Dashboard\TextDomainExporter;
use AutomatedEmails\App\Dashboard\DashboardData;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;

use function AutomatedEmails\Original\Utilities\Collection\_;

class DashboardDataDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    public function __construct(
        protected DashboardComponentsExporter $componentsExporter,
        protected StateExporter $stateExporter
    ) {}
    
    static public function type(): string
    {
        return DashboardData::class;   
    } 

    public function create(): object
    {
        //Plugins can require this as a dependency and call the addExporter() method to add extra data
        return new DashboardData(
            dashboardExporters: _(
                $this->componentsExporter,
                $this->stateExporter,
                new TextDomainExporter,
                new FieldsToSaveExporter,
                new NoncesExporter
                //heres where we'd add the new hyptethical preloaded data exporter
            )
        );
    } 
}