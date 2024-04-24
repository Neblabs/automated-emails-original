<?php

namespace AutomatedEmails\App\Creation\Data;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\JSONMapper;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

class DataTemplateStringToMappedEntityFactory implements CreatableEntities
{
    public function __construct(
        protected TemplateDefinition $templateDefinition,
        protected DataSetCollection $dataSetCollection,
        protected TemplateFactory $templateFactory,
        protected CreatableEntities $entitiesFactory
    ) {}
    
    /** @param ?string $data The JSON template */
    public function createEntity(mixed $data): Entity
    {
        (string) $JSON = $data;
        (object) $textTemplate = $this->templateFactory->createTextTemplate($JSON);
        (object) $jsonMapper = new JSONMapper($this->templateDefinition->definition()->asArray());

        // process the template to mapped object
        return $this->entitiesFactory->createEntity($jsonMapper->map($JSON));
    } 

    public function createEntities(mixed $entitesData): Entities
    {
        
    } 
}