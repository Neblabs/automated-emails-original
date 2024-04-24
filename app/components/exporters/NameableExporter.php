<?php

namespace AutomatedEmails\App\Components\Exporters;

use AutomatedEmails\App\Components\Abilities\ComponentExportable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;

class NameableExporter implements ComponentExportable
{
    /** @param Nameable $component */
    public function export(mixed $component): Collection
    {
        return _(
            name: (string) $component->name()
        );
    } 
}