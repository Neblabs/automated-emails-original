<?php

namespace AutomatedEmails\App\Components\Exporters\Passable;

use AutomatedEmails\App\Components\CategorizedByItsOwnTypeExporter;
use AutomatedEmails\App\Components\Exporters\ComponentExporterComposite;
use AutomatedEmails\App\Components\Exporters\ComponentsExporter;
use AutomatedEmails\App\Components\Exporters\DescriptableExporter;
use AutomatedEmails\App\Components\Exporters\IdentifiableExporter;
use AutomatedEmails\App\Components\Exporters\NameableExporter;

use function AutomatedEmails\Original\Utilities\Collection\_;

class PassableCompositesExporter extends ComponentsExporter
{
    public function key(): string
    {
        return 'passable';
    } 

    public function export(): array
    {
        (object) $passableExporter = new CategorizedByItsOwnTypeExporter(
            new ComponentExporterComposite(_(
                new IdentifiableExporter,
                new NameableExporter,
            ))
        );

        return $this->components->all()->map($passableExporter->export(...))->flatten()->asArray();
    } 
}