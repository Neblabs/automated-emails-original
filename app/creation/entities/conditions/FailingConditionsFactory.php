<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Domain\Conditions\Builtin\Failing;
use AutomatedEmails\App\Domain\Conditions\Condition;
use AutomatedEmails\App\Domain\Conditions\Conditions;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

class FailingConditionsFactory implements CreatableEntities
{
    public function createEntity(mixed $data): Condition
    {
        return new Failing;
    } 

    public function createEntities(mixed $entitesData): Conditions
    {
        return new Conditions([
            $this->createEntity($entitesData)
        ]);
    } 
}