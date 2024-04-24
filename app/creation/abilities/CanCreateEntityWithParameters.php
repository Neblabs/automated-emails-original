<?php

namespace AutomatedEmails\App\Creation\Abilities;

use AutomatedEmails\Original\Data\Query\Parameters;
use AutomatedEmails\Original\Domain\Entity;

interface CanCreateEntityWithParameters
{
    public function createEntity(mixed $data, Parameters $parameters) : Entity;
}