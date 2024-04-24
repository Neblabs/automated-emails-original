<?php

namespace AutomatedEmails\App\Creation\Entities\Conditionroots;

use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Creation\Entities\Conditions\ConditionFromIdentifierFactory;
use AutomatedEmails\App\Creation\Entities\Conditions\ConditionFromTemplateFactory;
use AutomatedEmails\App\Creation\Entities\Conditions\ConditionOptionsMapperMetaFactory;
use AutomatedEmails\App\Creation\Entities\Conditions\ConditionsFromTemplateFactory;
use AutomatedEmails\App\Creation\Entities\Conditions\FromRegisteredComponentsConditionTemplateFactory;
use AutomatedEmails\App\Creation\Entities\Conditions\PassableCompositeConditionFromMappedTemplateFactory;
use AutomatedEmails\App\Creation\Entities\Conditions\PassableCompositeFactory;
use AutomatedEmails\App\Creation\Entities\Conditions\SubjectConditionFromMappedTemplateFactory;
use AutomatedEmails\App\Creation\Entities\CreatableEntityFromTemplate;
use AutomatedEmails\App\Domain\ConditionRoots\Templates\ConditionsRootTemplate;
use AutomatedEmails\App\Domain\Conditions\Templates\ConditionTemplate;
use AutomatedEmails\App\Domain\Conditions\Templates\PassableCompositeConditionsTemplate;
use AutomatedEmails\App\Domain\Conditions\Templates\SubjectConditionTemplate;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetColectionGetter;
use AutomatedEmails\App\Domain\Templates\EmptyTemplate;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Domain\Entity;

class ConditionsRootFromTemplateFactory implements CanCreateEntity
{
    protected DataSetColectionGetter $dataSetColectionGetter;

    public function __construct(
        protected Components $conditionComponents,
        protected Components $passableCompositeComponents,
        protected TemplateFactory $templateFactory
    ) {}

    public function setDataSetCollectionGetter(DataSetColectionGetter $dataSetColectionGetter) : void
    {
        $this->dataSetColectionGetter = $dataSetColectionGetter;
    }

    /** @param string|StringManager $data */
    public function createEntity(mixed $data): Entity
    {
        (object) $creatableEntityFromTemplate = new CreatableEntityFromTemplate(
            templateDefinition: new ConditionsRootTemplate,
            entityFromMappedObjectFactory: $this->mappedConditionsRootFactory()
        );

        return $creatableEntityFromTemplate->createEntity($data);
    } 

    protected function mappedConditionsRootFactory() : ConditionsRootFromMappedFactory
    {
        return new ConditionsRootFromMappedFactory(
            passableCompositeFactory: new PassableCompositeFactory(
                passableCompositeComponents: $this->passableCompositeComponents,
            ),
            subjectConditionFromTemplateFactory: $this->subjectConditionFromTemplateFactory()
        );     
    }
    
    protected function subjectConditionFromTemplateFactory() : CreatableEntityFromTemplate
    {
        (object) $subjectConditionFromMappedTemplateFactory = new SubjectConditionFromMappedTemplateFactory(
            templateFactory: $this->templateFactory,
            passableCompositeConditionFromMappedTemplateFactory: new PassableCompositeConditionFromMappedTemplateFactory(
                passableCompositeComponents: $this->passableCompositeComponents,
                conditionsFromTemplateFactory: $this->conditionsFromTemplateFactory(),
                passableCompositeFactory: new PassableCompositeFactory(
                    passableCompositeComponents: $this->passableCompositeComponents,
                )
            )
        );

        $subjectConditionFromMappedTemplateFactory->setData($this->dataSetColectionGetter->dataSetCollection());

        return new CreatableEntityFromTemplate(
            templateDefinition: new SubjectConditionTemplate(
                new PassableCompositeConditionsTemplate
            ),
            entityFromMappedObjectFactory: $subjectConditionFromMappedTemplateFactory
        );
    }

    protected function conditionsFromTemplateFactory() : ConditionsFromTemplateFactory
    {
        (object) $conditionOptionsMapperMetaFactory = new ConditionOptionsMapperMetaFactory(
            conditionTemplateFactory: new FromRegisteredComponentsConditionTemplateFactory(
                $this->conditionComponents
            ),
            templateFactory: $this->templateFactory
        );

        $conditionOptionsMapperMetaFactory->setData($this->dataSetColectionGetter->dataSetCollection());

        (object) $conditionFromTemplateFactory = new ConditionFromTemplateFactory(
            genericConditionTemplate: new ConditionTemplate(
                new EmptyTemplate
            ),
            conditionOptionsMapperMetaFactory: $conditionOptionsMapperMetaFactory,
            conditionFromIdentifierFactory: new ConditionFromIdentifierFactory(
                $this->conditionComponents
            )
        );

        $conditionFromTemplateFactory->setData($this->dataSetColectionGetter->dataSetCollection());

        return new ConditionsFromTemplateFactory(
            $conditionFromTemplateFactory
        );   
    }
}