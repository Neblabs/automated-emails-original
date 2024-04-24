<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Components\Exporters\Conditions\ConditionsExporter;
use AutomatedEmails\App\Components\Exporters\Dashboard\DashboardComponentsExporter;
use AutomatedEmails\App\Components\Exporters\Data\DatasExporter;
use AutomatedEmails\App\Components\Exporters\Data\DataTypesExporter;
use AutomatedEmails\App\Components\Exporters\Data\FormsExporter;
use AutomatedEmails\App\Components\Exporters\Data\ValuesExporter;
use AutomatedEmails\App\Components\Exporters\Events\CategorizedEventsExporter;
use AutomatedEmails\App\Components\Exporters\Events\EventsExporter;
use AutomatedEmails\App\Components\Exporters\Passable\PassableCompositesExporter;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;

use function AutomatedEmails\Original\Utilities\Collection\_;

class DashboardComponentsExporterDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    public function __construct(
        protected Components $eventComponents,
        protected Components $dataTypeComponents, 
        protected Components $dataComponents,
        protected Components $conditionComponents,
        protected Components $passableCompositeComponents
    ) {}
    
    static public function type(): string
    {
        return DashboardComponentsExporter::class;   
    } 

    public function create(): DashboardComponentsExporter
    {
        return new DashboardComponentsExporter(
            dashboardExporters: _(
                new EventsExporter($this->eventComponents),
                new DataTypesExporter($this->dataTypeComponents),
                new DatasExporter($this->dataComponents),
                new ValuesExporter($this->dataTypeComponents),
                new FormsExporter,
                new ConditionsExporter(
                    dataTypeComponents: $this->dataTypeComponents,
                    conditionComponents: $this->conditionComponents
                ),
                new PassableCompositesExporter($this->passableCompositeComponents)
            )
        );
    } 
}