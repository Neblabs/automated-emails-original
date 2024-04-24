<?php

namespace AutomatedEmails\App\Creation\Templates;

use AutomatedEmails\App\Components\Abilities\Templateable;
use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\JSONMapper;
use AutomatedEmails\Original\Collections\MappedObject;

class TemplateFromDataFactory
{
    public function __construct(
        protected DataSetCollection $dataSetCollection,
        protected TemplateDefinition $templateDefinition,
        protected TemplateFactory $templateFactory
    ) {}
    
    public function create(string $jsonTemplate) : MappedObject
    {
        (object) $mapper = new JSONMapper($this->templateDefinition->definition()->asArray());

        (object) $textTemplate = $this->templateFactory->createTextTemplate($jsonTemplate);

        return $mapper->map($this->textTemplate->render($dataSetCollection));
    }
}