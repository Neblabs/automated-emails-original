<?php

namespace AutomatedEmails\App\Creation\Entities;

use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\JSONMapper;
use AutomatedEmails\Original\Domain\Entity;

class CreatableEntityFromTemplate implements CanCreateEntity
{
    protected JSONMapper $JSONMapper;

    public function __construct(
        protected CanCreateEntity $entityFromMappedObjectFactory,
        TemplateDefinition $templateDefinition,
    ) {
        $this->JSONMapper = new JSONMapper($templateDefinition->definition());
    }
    
    /** @param string $data json template */
    public function createEntity(mixed $data): Entity
    {
        (object) $mappedEntity = $this->JSONMapper->map($data);        

        return $this->entityFromMappedObjectFactory->createEntity($mappedEntity);
    } 
}
