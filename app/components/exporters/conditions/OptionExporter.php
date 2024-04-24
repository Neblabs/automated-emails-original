<?php

namespace AutomatedEmails\App\Components\Exporters\Conditions;

use AutomatedEmails\App\Components\Abilities\ComponentExportable;
use AutomatedEmails\App\Components\Abilities\HasLabels;
use AutomatedEmails\App\Components\Abilities\HasTemplateOptions;
use AutomatedEmails\App\Components\Abilities\RenderableOptions;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;
use Exception;

use function AutomatedEmails\Original\Utilities\Collection\{a, _};

class OptionExporter implements ComponentExportable
{
    public function __construct(
        protected HasTemplateOptions&RenderableOptions&HasLabels $optionsComponent
    ) {}
    
    public function export(mixed $optionId) : Collection
    {
        /** @var Types */
        (object) $optionType = $this->optionsComponent->options()->definition()->get($optionId);

        return _(
            type: $optionId,
            valueType: $this->valueTypeString($optionType),
            labels: _($this->optionsComponent->labels()->get($optionId)['labels'])->append(a(
                __default: 'This key exists so that parsers wont transform this into an associative array if this component provides no labels'
            )),
            value: a(
                allowed: ($this->optionsComponent->labels()->get($optionId)['values'])($optionType->getAllowedValues() ?? _()),
                default: $optionType->hasDefaultValue() ? $optionType->getDefaultValue() : ($optionType->getType() === Types::BOOLEAN? true: null)
            )
        );
    }

    protected function valueTypeString(Types $type) : string
    {
        return match($type->getType()) {
            Types::BOOLEAN => 'boolean',
            Types::COLLECTION => 'collection',
            Types::STRING => !$type->anyValueIsAllowed()? 'select' : 'text',
            default => 'text'
        };
    }
    
}