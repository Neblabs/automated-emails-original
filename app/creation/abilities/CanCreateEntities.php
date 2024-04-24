<?php

namespace AutomatedEmails\App\Creation\Abilities;

use AutomatedEmails\Original\Domain\Entities;

interface CanCreateEntities
{
    public function createEntities(mixed $entitesData) : Entities;
}