<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Domain\Conditions\SubjectConditions;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\App\Domain\Data\Abilities\SettableDataSetCollection;
use AutomatedEmails\Original\Collections\JSONMapper;
use AutomatedEmails\Original\Collections\MappedObject;
use AutomatedEmails\Original\Domain\Entity;
use stdClass;

class SubjectConditionFromMappedTemplateFactory implements CanCreateEntity, SettableDataSetCollection
{
    protected DataSetCollection $dataSetCollection;

    public function __construct(
        protected TemplateFactory $templateFactory,
        protected PassableCompositeConditionFromMappedTemplateFactory $passableCompositeConditionFromMappedTemplateFactory
    ) {}
    
    public function setData(DataSetCollection $dataSetCollection): void
    {
        $this->dataSetCollection = $dataSetCollection;    
    } 

    /** @param MappedObject|stdClass $data */
    public function createEntity(mixed $data): SubjectConditions
    {
        (string) $dataPlaceholder = $data->data;

        (object) $dataTemplate = $this->templateFactory->createDataTemplate(
            template: $dataPlaceholder->get()
        );

        return new SubjectConditions(
            data: $dataTemplate->getData($this->dataSetCollection),
            passableComposite: $this->passableCompositeConditionFromMappedTemplateFactory->createEntity($data->passableCompositeConditions)
        );
    } 
}