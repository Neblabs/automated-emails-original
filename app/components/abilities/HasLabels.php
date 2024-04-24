<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\Original\Collections\Collection;

interface HasLabels
{
    public function labels() : Collection; 
}