<?php

namespace AutomatedEmails\App\Components\Conditions;

use AutomatedEmails\Original\Collections\Collection;

interface ConditionComponents
{
    public function conditions() : Collection; 
}