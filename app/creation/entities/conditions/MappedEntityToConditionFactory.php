<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\Original\Collections\MappedObject;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

class MappedEntityToConditionFactory implements CreatableEntities
{
    /** @param MappedObject $data */
    public function createEntity(mixed $data): Entity
    {
        (string) $conditionId = $data->type;

        // here we'll actually first check if we have a custom condition factry, if we do, use that. if we dont, fallback to this implmenetation
        (object) $condition = new $conditionId(...$data->options->asArray());

        $condition->setData($postData->entity());

        return $condition;
    } 

    /** @param Collection<MappedObject> $data */
    public function createEntities(mixed $entitesData): Entities
    {
        
    } 
}

