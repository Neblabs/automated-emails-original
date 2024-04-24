<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Domain\Conditions\Condition;
use AutomatedEmails\App\Domain\Conditions\Conditions;
use AutomatedEmails\App\Domain\Conditions\Templates\ConditionTemplate;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\Original\Collections\JSONMapper;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

use function AutomatedEmails\Original\Utilities\Callables\call;
use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\i;

class ConditionFromTemplateFactory implements CanCreateEntity
{
    protected JSONMapper $JSONMapper;
    protected DataSetCollection $dataSetCollection;

    public function __construct(
        protected ConditionTemplate $genericConditionTemplate,
        protected ConditionOptionsMapperMetaFactory $conditionOptionsMapperMetaFactory,
        protected ConditionFromIdentifierFactory $conditionFromIdentifierFactory
    ) {
        $this->JSONMapper = new JSONMapper($genericConditionTemplate->definition());
    }
    
    public function setData(DataSetCollection $dataSetCollection) : void
    {
        $this->conditionOptionsMapperMetaFactory->setData($dataSetCollection);
    }

    public function createEntity(mixed $data): Entity
    {
        (string) $jsonTemplate = $data;
        (object) $mappedConditionWithRawOptions = $this->JSONMapper->map(
            $jsonTemplate
        );
        (string) $conditionType = $mappedConditionWithRawOptions->type;
        (object) $conditionOptionsFactory = $this->conditionOptionsMapperMetaFactory
                                                 ->createForType(
                                                    $conditionType
                                                );

        (object) $mappedConditionOptions = $conditionOptionsFactory->map(
            wp_json_encode($mappedConditionWithRawOptions->rawDataFound->get('options'))
        );

        return $this->conditionFromIdentifierFactory->create(
            identifier: $conditionType,
            options: $mappedConditionOptions->asArray()
        );   
    }
}