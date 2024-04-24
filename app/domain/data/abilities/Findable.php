<?php

namespace AutomatedEmails\App\Domain\Data\Abilities;

use AutomatedEmails\Original\Data\Model\Gateway;

interface Findable
{
    public function gateway() : Gateway; 
}