<?php

namespace AutomatedEmails\App\Components\Exporters;

use AutomatedEmails\App\Components\Abilities\ComponentExportable;
use AutomatedEmails\App\Components\Abilities\Descriptable;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;

class DescriptableExporter implements ComponentExportable
{
    /** @param Descriptable $component */
    public function export(mixed $component): Collection
    {
        return _(
            description: (string) $component->description()
        );
    } 
}