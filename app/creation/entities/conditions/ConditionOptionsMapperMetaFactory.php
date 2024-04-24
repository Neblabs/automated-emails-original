<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Creation\Entities\Abilities\ConditionTemplateFactory;
use AutomatedEmails\App\Creation\Entities\Conditions\ConditionOptionsMapperFactory;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\App\Domain\Data\Abilities\SettableDataSetCollection;

class ConditionOptionsMapperMetaFactory implements SettableDataSetCollection
{
    protected DataSetCollection $dataSetCollection;

    public function __construct(
        protected ConditionTemplateFactory $conditionTemplateFactory,
        protected TemplateFactory $templateFactory
    ) {}
    
    public function setData(DataSetCollection $dataSetCollection): void
    {
        $this->dataSetCollection = $dataSetCollection;
    } 

    public function createForType(string $conditionType) : ConditionOptionsMapperFactory
    {
        (object) $conditionOptionsMapperFactory = new ConditionOptionsMapperFactory(
            conditionsTemplate: $this->conditionTemplateFactory->create(type: $conditionType),
            templateFactory: $this->templateFactory
        );

        $conditionOptionsMapperFactory->setData($this->dataSetCollection);

        return $conditionOptionsMapperFactory;
    }
}