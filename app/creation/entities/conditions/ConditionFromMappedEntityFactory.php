<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\Original\Collections\MappedObject;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

class ConditionFromMappedEntityFactory implements CreatableEntities
{
    public function __construct(
        protected DataSetCollection $dataSetCollection
    ) {}
    
    /** @param MappedObject $data */
    public function createEntity(mixed $data): Entity
    {
        (string) $conditionId = $data->type;

        // here we'll actually first check if we have a custom condition factry, if we do, use that. if we dont, fallback to this implmenetation
        (object) $condition = new $conditionId(...$data->options->asArray());

        /** @var Data */
        (object) $data = $this->dataSetCollection->dataSet($dataTypeId);

        $condition->setData($data);

        return $condition;
    } 

    public function createEntities(mixed $entitesData): Entities
    {
        
    } 
}