<?php

namespace AutomatedEmails\App\Components\Exporters;

use AutomatedEmails\App\Components\Abilities\ComponentExportable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;

class IdentifiableExporter implements ComponentExportable
{
    /** @param Identifiable $component */
    public function export(mixed $component): Collection
    {
        return _(
            type: (string) $component->identifier()
        );
    } 
}