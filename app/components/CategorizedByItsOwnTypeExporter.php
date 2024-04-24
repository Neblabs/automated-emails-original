<?php

namespace AutomatedEmails\App\Components;

use AutomatedEmails\App\Components\Abilities\ComponentExportable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;

class CategorizedByItsOwnTypeExporter implements ComponentExportable
{
    public function __construct(
        protected ComponentExportable $exporter
    ) {}
    
    /** @param Identifiable $component */
    public function export(mixed $component): Collection
    {
        return _([
            $component->identifier() => $this->exporter->export($component)
        ]);
    } 
}