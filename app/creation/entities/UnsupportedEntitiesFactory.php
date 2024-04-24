<?php

namespace AutomatedEmails\App\Creation\Entities;

use AutomatedEmails\App\Creation\Abilities\CanCreateEntities;
use AutomatedEmails\App\Creation\Abilities\CanCreateEntitiesWithParameters;
use AutomatedEmails\Original\Data\Query\Parameters;
use AutomatedEmails\Original\Domain\Entities;
use Exception;

class UnsupportedEntitiesFactory implements CanCreateEntities
{
    public function createEntities(mixed $entitesData): Entities
    {
        throw new Exception('not supported yet!');
    } 
}