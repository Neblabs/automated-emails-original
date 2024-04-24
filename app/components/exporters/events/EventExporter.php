<?php

namespace AutomatedEmails\App\Components\Exporters\Events;

use AutomatedEmails\App\Components\Abilities\ComponentExportable;
use AutomatedEmails\App\Components\Abilities\DataTypeable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Provider;
use AutomatedEmails\App\Components\ComponentWithDependents;
use AutomatedEmails\App\Components\Exporters\ComponentExporterComposite;
use AutomatedEmails\App\Components\Exporters\DescriptableExporter;
use AutomatedEmails\App\Components\Exporters\IdentifiableExporter;
use AutomatedEmails\App\Components\Exporters\NameableExporter;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Collection\a;

class EventExporter implements ComponentExportable
{
    /** @param Provider&ComponentWithDependents $component */
    public function export(mixed $component): Collection
    {
        (object) $templateExporter = new ComponentExporterComposite(_(
            new IdentifiableExporter,
            new NameableExporter,
            new DescriptableExporter
        ));

        return _(
             data: $component->provides()->dataTypes->map(
                fn(Collection $dataComponents) => $dataComponents->mapUsing(identifier: null)->asArray()
             )->asArray(),
             templates: $component->dependents()->all()->map(fn($templateComponent) => $templateExporter->export($templateComponent)->asArray())->asArray()
        );
    } 
}