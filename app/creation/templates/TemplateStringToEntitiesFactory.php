<?php

namespace AutomatedEmails\App\Creation\Templates;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Abilities\CreatableEntitiesWithParameters;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\App\Domain\Templates\EntityTemplate;
use AutomatedEmails\App\Domain\Templates\EntityTemplates;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Data\Query\Parameters;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;
use function AutomatedEmails\Original\Utilities\Collection\_;

class TemplateStringToEntitiesFactory implements CreatableEntitiesWithParameters
{
    public function __construct(
        protected EntityTemplateFactory $entityTemplateFactory,
        protected DataSetCollection $dataSetCollection,
    ) {}

    public function createEntity(mixed $data, Parameters $parameters): Entity
    {
        /** @var EntityTemplate */
        (object) $entityTemplate = $this->entityTemplateFactory->createEntity($data);

        return $entityTemplate->create($this->dataSetCollection);    
    } 

    public function createEntities(mixed $entitesData, Parameters $parameters): Entities
    {
        $entitesData = $this->getJsonArray($entitesData);

        (object) $entityTemplates = $this->entityTemplateFactory->createEntities($entitesData);

        return $entityTemplates->create($this->dataSetCollection);
    } 

    protected function getJsonArray(mixed $entitesData) : string
    {
        if (is_array(($entitesData)) || $entitesData instanceof Collection) {
            return _($entitesData)->asJson()->get();
        }

        return $entitesData;
    }
    
}