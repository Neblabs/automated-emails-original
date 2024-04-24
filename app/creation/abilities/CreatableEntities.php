<?php

namespace AutomatedEmails\App\Creation\Abilities;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

interface CreatableEntities extends 
    CanCreateEntity, 
    CanCreateEntities
{

}