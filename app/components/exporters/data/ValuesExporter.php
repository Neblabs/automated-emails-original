<?php

namespace AutomatedEmails\App\Components\Exporters\Data;

use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Components\Data\DataTypeComponent;
use AutomatedEmails\App\Components\Exporters\ComponentExporterComposite;
use AutomatedEmails\App\Components\Exporters\ComponentsExporter;
use AutomatedEmails\App\Components\Exporters\DescriptableExporter;
use AutomatedEmails\App\Components\Exporters\FormableExporter;
use AutomatedEmails\App\Components\Exporters\IdentifiableExporter;
use AutomatedEmails\App\Components\Exporters\NameableExporter;

use function AutomatedEmails\Original\Utilities\Collection\{a, _};

class ValuesExporter extends ComponentsExporter
{
    public function key(): string
    {
        return 'values';   
    } 

    public function export(): array
    {
        /** @var \Mockery\MockInterface&Components */
        (object) $dataTypeComponents = $this->components;   
        (object) $valueExporter = new ComponentExporterComposite(_(
            new IdentifiableExporter,
            new FormableExporter,
            new NameableExporter,
            new DescriptableExporter
        ));

        return $dataTypeComponents->all()->mapWithKeys(
            fn(DataTypeComponent $dataTypeComponent) => a(
                key: $dataTypeComponent->identifier(),
                value: $dataTypeComponent->values()->map($valueExporter->export(...))->asArray()
            )
        )->asArray();
    } 
}