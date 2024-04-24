<?php

namespace AutomatedEmails\App\Creation\Entities\Abilities;

use AutomatedEmails\Original\Collections\Collection;

interface HandleableUncreatableEntities
{
    public function handle(array $allEntitiesData, array $validEntitiesData) : void;
}