<?php

namespace AutomatedEmails\App\Components\Exporters\Data;

use AutomatedEmails\App\Components\Abilities\DashboardExportable;
use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Components\Exporters\ComponentExporterComposite;
use AutomatedEmails\App\Components\Exporters\IdentifiableExporter;
use AutomatedEmails\App\Components\Exporters\NameableExporter;
use AutomatedEmails\App\Components\Exporters\SingularNameableExporter;

use function AutomatedEmails\Original\Utilities\Collection\_;

class DataTypesExporter implements DashboardExportable
{
    public function __construct(
        protected Components $dataTypeComponents
    ) {}
    
    public function key(): string
    {
        return 'dataTypes';
    } 

    public function export(): array
    {
        (object) $componentExporter = new ComponentExporterComposite(_(
            new IdentifiableExporter,
            new NameableExporter,
            new SingularNameableExporter
        ));

        return $this->dataTypeComponents->all()->map($componentExporter->export(...))->asArray();
    } 
}