<?php

namespace AutomatedEmails\Original\Dependency;

use AutomatedEmails\Original\Dependency\Abilities\Context;

trait WillAlwaysMatch 
{
    public function canBeCreated(Context $context) : bool
    {
        return true;
    }  
}