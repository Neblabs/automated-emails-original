<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\Original\Characters\StringManager;

interface HasConditionsTemplate
{
    public function template() : StringManager; 
}