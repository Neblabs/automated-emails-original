<?php

namespace AutomatedEmails\App\Components\Exporters\Data;

use AutomatedEmails\App\Components\Abilities\DashboardExportable;

use function AutomatedEmails\Original\Utilities\Collection\{a, _};

class FormsExporter implements DashboardExportable
{
    public function key(): string
    {
        return 'forms';   
    } 

    public function export(): array
    {
        /* todo: iplement forms a s components, right nowwe'll just hard-code
        (object) $formExporter = new ComponentExporterComposite(_(
            new IdentifiableExporter,
            new FormableExporter,
            new NameableExporter,
            new DescriptableExporter
        ));

        return $this->components->all()->map($formExporter->export(...))->asArray();*/
        return [
            a(type: 'text', name: 'Text'),
            a(type: 'text->email', name: 'Email'),
            a(type: 'number', name: 'Number'),
            a(type: 'number->integer', name: 'Integer'),
            a(type: 'number->float', name: 'Decimal'),
        ];
    } 
}