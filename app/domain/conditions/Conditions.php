<?php

namespace AutomatedEmails\App\Domain\Conditions;

use AutomatedEmails\App\Domain\Conditions\Abilities\PassableItems;
use AutomatedEmails\App\Domain\Data\Abilities\Subject;
use AutomatedEmails\Original\Domain\Entities;

Class Conditions extends Entities
{
    protected function getDomainClass() : string
    {
        return Condition::class;
    }
}