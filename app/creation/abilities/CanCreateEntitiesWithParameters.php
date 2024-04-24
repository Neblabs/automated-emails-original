<?php

namespace AutomatedEmails\App\Creation\Abilities;

use AutomatedEmails\Original\Data\Query\Parameters;
use AutomatedEmails\Original\Domain\Entities;

interface CanCreateEntitiesWithParameters
{
    public function createEntities(mixed $entitesData, Parameters $parameters) : Entities;
}