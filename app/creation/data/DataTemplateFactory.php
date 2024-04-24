<?php

namespace AutomatedEmails\App\Creation\Data;

use AutomatedEmails\App\Domain\Data\DataTemplate;

class DataTemplateFactory
{
    public function __construct(
        protected FindableDataFactory $findableDataFactory
    ) {}

    public function create(string $template) : DataTemplate
    {
        return new DataTemplate(
            template: $template, 
            findableDataFactory: $this->findableDataFactory
        );
    }
}