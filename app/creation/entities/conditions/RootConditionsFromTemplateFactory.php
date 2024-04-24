<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\App\Domain\Conditions\Conditions;
use AutomatedEmails\Original\Collections\JSONMapper;
use AutomatedEmails\Original\Domain\Entity;

class RootConditionsFromTemplateFactory implements CanCreateEntity
{
    public function __construct(
        protected JSONMapper $rootCondtionsTemplate,
    ) {}
    
    /** @param string $data */
    public function createEntity(mixed $data): Conditions
    {
        (object) $mappedRootConditions = $this->rootCondtionsTemplate->map($data);

        (object) $conditions = new Conditions([]);

        $conditions->setRoot();
    } 
}