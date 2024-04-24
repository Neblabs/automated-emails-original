<?php

namespace AutomatedEmails\App\Components\Abilities;

interface Dependent
{
    public function dependsOn() : string; 
}