<?php

namespace AutomatedEmails\App\Components\Exporters;

use AutomatedEmails\App\Components\Abilities\ComponentExportable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\SingularNameable;
use AutomatedEmails\Original\Collections\Collection;
use function AutomatedEmails\Original\Utilities\Collection\_;

class SingularNameableExporter implements ComponentExportable
{
    /** @param SingularNameable $component */
    public function export(mixed $component): Collection
    {
        return _(
            nameSingular: (string) $component->nameSingular()
        );
    } 
}