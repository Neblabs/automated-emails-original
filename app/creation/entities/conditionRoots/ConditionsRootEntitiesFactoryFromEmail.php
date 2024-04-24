<?php

namespace AutomatedEmails\App\Creation\Entities\Conditionroots;

use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Creation\Abilities\CreatableEntitiesWithParameters;
use AutomatedEmails\App\Creation\Abilities\Exceptionhandlers\CanCreateEntityWhenNotEmpty;
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
use AutomatedEmails\App\Creation\Entities\SeparateCreatableEntitiesWithParameters;
use AutomatedEmails\App\Creation\Entities\UnsupportedEntitiesFactory;
use AutomatedEmails\App\Creation\Templates\MetaValueToEntitiesWithParametersFactory;
use AutomatedEmails\App\Domain\AutomatedEmails\AutomatedEmail;
use AutomatedEmails\App\Domain\ConditionRoots\Templates\ConditionsRootTemplate;
use AutomatedEmails\App\Domain\Conditions\Templates\ConditionTemplate;
use AutomatedEmails\App\Domain\Conditions\Templates\PassableCompositeConditionsTemplate;
use AutomatedEmails\App\Domain\Conditions\Templates\SubjectConditionTemplate;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetColectionGetter;
use AutomatedEmails\App\Domain\Data\Abilities\Datasetcolectiongetters\DataSetCollectionFromEmail;
use AutomatedEmails\App\Domain\Templates\EmptyTemplate;

class ConditionsRootEntitiesFactoryFromEmail
{
    public function __construct(
        protected ConditionsRootFromTemplateFactory $conditionsRootFromTemplateFactory
    ) {}
    
    public function create(AutomatedEmail $automatedEmail) : CreatableEntitiesWithParameters
    {
        $this->conditionsRootFromTemplateFactory->setDataSetCollectionGetter(new DataSetCollectionFromEmail($automatedEmail));

        return new MetaValueToEntitiesWithParametersFactory(
            new SeparateCreatableEntitiesWithParameters(
                entityFactory: new CanCreateEntityWhenNotEmpty(
                    $this->conditionsRootFromTemplateFactory,
                    exceptionMessage: 'Cannot create email because The Condition roots field from the database is empty.'
                ),
                entitiesFactory: new UnsupportedEntitiesFactory
            )
        );
    }

}