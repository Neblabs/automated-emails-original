<?php

namespace AutomatedEmails\App\Components\Exporters\Conditions;

use AutomatedEmails\App\Components\Abilities\ComponentExportable;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\{a, _};

class OptionsExporter implements ComponentExportable
{
    //$component is the optionsComonent
    public function export(mixed $component): Collection
    {
        (object) $optionsComponentExporter = new OptionExporter($component);

        return _(
            options: $component->render()->map(
                fn(array $row) => _($row)->map($optionsComponentExporter->export(...))->asArray()
            )
        );        
    } 
}