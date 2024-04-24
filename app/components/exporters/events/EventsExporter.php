<?php

namespace AutomatedEmails\App\Components\Exporters\Events;

use AutomatedEmails\App\Components\Abilities\DashboardExportable;
use AutomatedEmails\App\Components\Abilities\Groupable;
use AutomatedEmails\App\Components\Components;
use AutomatedEmails\Original\Characters\StringManager;

class EventsExporter implements DashboardExportable
{
    public function __construct(
        protected Components $eventComponents
    ) {}
    
    public function key(): string
    {
        return 'events';
    } 

    public function export(): array
    {
        /** @var \Mockery\MockInterface&Components */
        (object) $baseEventComponents = $this->eventComponents->baseOnly();
        //$this->eventComponents->baseOnly()
        (object) $eventGroups = $baseEventComponents->all()->mapUsing(group: null)->withoutDuplicates();

        (object) $categorizesEventsExporter = new CategorizedEventsExporter(
            $baseEventComponents
        );

        return $eventGroups->map(
            fn(string $group) => $categorizesEventsExporter->export($group)->asArray()
        )->asArray();   
    } 
}