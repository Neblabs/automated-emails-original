<?php

namespace AutomatedEmails\App\Components\Events;

use AutomatedEmails\Original\Collections\Collection;

interface EventComponents
{
    public function events() : Collection; 
}