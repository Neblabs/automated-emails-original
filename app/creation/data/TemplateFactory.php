<?php

namespace AutomatedEmails\App\Creation\Data;

use AutomatedEmails\App\Creation\Data\FindableDataFactory;
use AutomatedEmails\App\Domain\Data\DataTemplate;
use AutomatedEmails\App\Domain\Data\Placeholder;
use AutomatedEmails\App\Domain\Data\TextTemplate;
use Stringable;

class TemplateFactory
{
    public function __construct(
        protected FindableDataFactory $findableDataFactory,
    ) {}

    public function createTextTemplate(string|Stringable $template) : TextTemplate
    {
        return new TextTemplate((string) $template, $this);
    }

    public function createDataTemplate(string|Stringable $template) : DataTemplate
    {
        return new DataTemplate(
            template: $template, 
            findableDataFactory: $this->findableDataFactory
        );
    }

    public function createPlaceholder(array $matches) : Placeholder
    {
        (array) $data = [
            $dataTypeId,
            $dataValueId,
            $dataId,
        ] = $matches;
        
        return new Placeholder(
            dataTypeId: $dataTypeId,
            dataValueId: $dataValueId,
            dataId: $dataId,
            findableDataFactory: $this->findableDataFactory
        );
    }
}