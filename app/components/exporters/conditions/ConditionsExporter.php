<?php

namespace AutomatedEmails\App\Components\Exporters\Conditions;

use AutomatedEmails\App\Components\Abilities\DashboardExportable;
use AutomatedEmails\App\Components\Abilities\HasOptionsComponent;
use AutomatedEmails\App\Components\Abilities\HasRequirements;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Components\Data\DataTypeComponent;
use AutomatedEmails\Original\Characters\StringManager;

use function AutomatedEmails\Original\Utilities\Collection\a;

class ConditionsExporter implements DashboardExportable
{
    public function __construct(
        protected Components $dataTypeComponents,
        protected Components $conditionComponents
    ) {}
    
    public function key(): string
    {
        return 'conditions';
    } 

    public function export(): array
    {
        (object) $conditionExporter = new ConditionExporter;

        return $this->dataTypeComponents->all()->mapWithKeys(
                    fn(DataTypeComponent $dataTypeComponent) => a(
                        key: $dataTypeComponent->identifier(),
                        value: $this->conditionComponents->all()->filter(
                            fn(HasRequirements $conditionComponent) => $conditionComponent->requires()->dataTypes?->have($dataTypeComponent::class)
                        )->map($conditionExporter->export(...))->getValues()
                    )
                )->asArray();
    } 
}