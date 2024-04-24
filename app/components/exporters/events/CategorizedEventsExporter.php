<?php

namespace AutomatedEmails\App\Components\Exporters\Events;

use AutomatedEmails\App\Components\Abilities\Groupable;
use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Components\Exporters\ComponentExporterComposite;
use AutomatedEmails\App\Components\Exporters\DescriptableExporter;
use AutomatedEmails\App\Components\Exporters\IdentifiableExporter;
use AutomatedEmails\App\Components\Exporters\NameableExporter;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\i;

class CategorizedEventsExporter
{
    public function __construct(
        protected Components $baseEventComponents,
    ) {}
    
    public function export(string $group): Collection
    {
        (object) $onlyComponentsForThisDataType = fn(Groupable $eventComponent) => 
            i($eventComponent->group())->is($group);
        (object) $eventExporter = new ComponentExporterComposite(_(
            new IdentifiableExporter,
            new NameableExporter,
            new DescriptableExporter,
            new EventExporter,
        ));

        return _(
            name: $group,
            events: $this->baseEventComponents->all()->filter($onlyComponentsForThisDataType)
                                                     ->map(
                                                        fn($eventComponent) => $eventExporter->export($eventComponent)->asArray()
                                                     )->asArray()
        );
    } 
}