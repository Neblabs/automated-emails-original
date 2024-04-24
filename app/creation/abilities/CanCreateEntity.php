<?php

namespace AutomatedEmails\App\Creation\Abilities;

use AutomatedEmails\Original\Domain\Entity;

interface CanCreateEntity
{
    public function createEntity(mixed $data) : Entity;
}