<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\Original\Collections\Collection;

interface HasRequirements
{
    public function requires() : Collection; 
}