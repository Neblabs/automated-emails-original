<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\Original\Characters\StringManager;

interface HasDefaultConditions
{
    public function defaultConditionsMap() : StringManager; 
}