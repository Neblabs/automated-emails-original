<?php

namespace AutomatedEmails\App\Components\Exporters;

use AutomatedEmails\App\Components\Abilities\ComponentExportable;
use AutomatedEmails\App\Components\Abilities\Formable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;

class FormableExporter implements ComponentExportable
{
    /** @param Formable $component */
    public function export(mixed $component): Collection
    {
        return _(
            form: (string) $component->form()->identifier()
        );
    } 
}