<?php

namespace AutomatedEmails\Original\Environment;

use AutomatedEmails\Original\Environment\Abilities\Environment;

class Production implements Environment
{
    public function isProduction(): bool
    {
        return true;
    } 

    public function isDevelopment(): bool
    {
        return false;   
    }

    public function isTesting(): bool
    {
        return false;
    } 
}