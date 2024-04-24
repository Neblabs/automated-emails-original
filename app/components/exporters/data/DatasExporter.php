<?php

namespace AutomatedEmails\App\Components\Exporters\Data;

use AutomatedEmails\App\Components\Abilities\DashboardExportable;
use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Components\Exporters\ComponentExporterComposite;
use AutomatedEmails\App\Components\Exporters\DescriptableExporter;
use AutomatedEmails\App\Components\Exporters\IdentifiableExporter;
use AutomatedEmails\App\Components\Exporters\NameableExporter;
use AutomatedEmails\App\Components\Exporters\SingularNameableExporter;

use function AutomatedEmails\Original\Utilities\Collection\_;

class DatasExporter implements DashboardExportable
{
    public function __construct(
        protected Components $dataComponents
    ) {}
    
    public function key(): string
    {
        return 'data';
    } 

    public function export(): array
    {
        (object) $dataExporter = new ComponentExporterComposite(_(
            new IdentifiableExporter,
            new NameableExporter,
            new DescriptableExporter
        ));

        (object) $componentsExporter = new CategorizedDataExporter(
            components: $this->dataComponents,
            componentExporter: $dataExporter
        );

        return $componentsExporter->export()->asArray();
    } 
}