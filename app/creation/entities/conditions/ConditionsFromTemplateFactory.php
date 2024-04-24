<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Creation\Abilities\CanCreateEntities;
use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\App\Domain\Conditions\Conditions;
use AutomatedEmails\Original\Domain\Entities;

use function AutomatedEmails\Original\Utilities\Callables\call;
use function AutomatedEmails\Original\Utilities\Text\i;

class ConditionsFromTemplateFactory implements CanCreateEntities
{
    public function __construct(
        protected CanCreateEntity $conditionFromTemplateFactory
    ) {}
    
    /** @param string $entitesData A json array of collection templates */
    public function createEntities(mixed $entitesData): Entities
    {
        return new Conditions(
            i($entitesData)->import()->map(
                $this->conditionFromTemplateFactory->createEntity(...)
            )
        );
    } 
}