<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\App\Domain\Data\Abilities\SettableDataSetCollection;
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\JSONMapper;
use AutomatedEmails\Original\Collections\MappedObject;

class ConditionOptionsMapperFactory implements SettableDataSetCollection
{
    protected JSONMapper $JSONMapper;
    protected DataSetCollection $dataSetCollection;

    public function __construct(
        protected TemplateDefinition $conditionsTemplate,
        protected TemplateFactory $templateFactory
    ) {
        $this->JSONMapper = new JSONMapper(map: $conditionsTemplate->definition());
    }
    
    public function setData(DataSetCollection $dataSetCollection) : void
    {
        $this->dataSetCollection = $dataSetCollection;
    }

    public function map(string $jsonOptions) : MappedObject
    {
        (object) $textTemplate = $this->templateFactory->createTextTemplate($jsonOptions);

        return $this->JSONMapper->map($textTemplate->render($this->dataSetCollection));
    }
}