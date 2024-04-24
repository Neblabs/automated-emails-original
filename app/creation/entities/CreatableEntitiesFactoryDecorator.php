<?php

namespace AutomatedEmails\App\Creation\Entities;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

abstract class CreatableEntitiesFactoryDecorator implements CreatableEntities
{
    public function __construct(
        protected CreatableEntities $creatableEntities
    ) {}
}