<?php

namespace AutomatedEmails\App\Components\Exporters\Conditions;

use AutomatedEmails\App\Components\Abilities\ComponentExportable;
use AutomatedEmails\App\Components\Abilities\HasLabels;
use AutomatedEmails\App\Components\Abilities\HasOptionsComponent;
use AutomatedEmails\App\Components\Abilities\HasTemplateOptions;
use AutomatedEmails\App\Components\Abilities\RenderableOptions;
use AutomatedEmails\App\Components\Exporters\ComponentExporterComposite;
use AutomatedEmails\App\Components\Exporters\DescriptableExporter;
use AutomatedEmails\App\Components\Exporters\IdentifiableExporter;
use AutomatedEmails\App\Components\Exporters\NameableExporter;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;

class ConditionExporter implements ComponentExportable
{
    /** @param HasOptionsComponent $component */
    public function export(mixed $component): Collection
    {
        /** @var HasTemplateOptions&RenderableOptions&HasLabels */
        (object) $optionsComponent = $component->options();
        (object) $optionsExporter = new OptionsExporter;
        (object) $conditionExporter = new ComponentExporterComposite(_(
            new IdentifiableExporter,
            new NameableExporter,
            new DescriptableExporter,
        ));

        return _([
            ...$conditionExporter->export($component),
            ...$optionsExporter->export($optionsComponent)->asArray()
        ]);
    } 
}