<?php

namespace AutomatedEmails\App\Creation\Abilities;

use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;
use Throwable;

interface HandlesCreatableEntitiesExceptions
{
    public function handleCreateEntityException(Throwable $exception, mixed $data) : ?Entity;
    public function handleCreateEntitiesException(Throwable $exception, mixed $entitesData) : ?Entities;
}