<?php

namespace AutomatedEmails\App\Components\Exporters\Data;

use AutomatedEmails\App\Components\Abilities\ComponentExportable;
use AutomatedEmails\App\Components\Abilities\DataTypeable;
use AutomatedEmails\App\Components\Abilities\Exportable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Provider;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Components\ComponentWithDependents;
use AutomatedEmails\App\Components\Exporters\ComponentExporterComposite;
use AutomatedEmails\App\Components\Exporters\DescriptableExporter;
use AutomatedEmails\App\Components\Exporters\IdentifiableExporter;
use AutomatedEmails\App\Components\Exporters\NameableExporter;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\i;

class CategorizedDataExporter implements Exportable
{
    /*
    (object) $dataComponentExporter = new ComponentExporterComposite(_(
            new IdentifiableExporter,
            new NameableExporter,
            new DescriptableExporter
        ));
     */
    public function __construct(
        protected Components $components,
        protected ComponentExportable $componentExporter
    ) {}
    
    public function export(): Collection
    {
        (object) $components = _();

        /** @var Identifiable&DataTypeable */
        foreach ($this->components->all()->asArray() as $dataComponent) {
            (string) $dataType = (string) $dataComponent->dataType()->identifier();
            
            $components->setIfDoesNotHave(key: $dataType, value: _());

            $components->get($dataType)->push($this->componentExporter->export($dataComponent));
        }

        return $components;
    } 
}