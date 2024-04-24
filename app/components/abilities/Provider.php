<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\Original\Collections\Collection;

interface Provider
{
    public function provides() : Collection; 
}