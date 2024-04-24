<?php

namespace AutomatedEmails\App\Components\Exporters;

use AutomatedEmails\App\Components\Abilities\ComponentExportable;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;

class ComponentExporterComposite implements ComponentExportable
{
    public function __construct(
        protected Collection/*<ComponentExportable>*/ $componentExportables
    ) {}
    
    public function export(mixed $componentToExport): Collection
    {
        (array) $component = [];

        foreach ($this->componentExportables->asArray() as $exportable) {
            $component = [
                ...$component,
                ...$exportable->export($componentToExport)
            ];
        }

        return _($component);
    } 
}