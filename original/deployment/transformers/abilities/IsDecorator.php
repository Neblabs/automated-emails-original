<?php

namespace AutomatedEmails\Original\Deployment\Transformers\Abilities;

use AutomatedEmails\Original\Characters\StringManager;

interface IsDecorator
{
    public function decorated() : Transformable; 
}