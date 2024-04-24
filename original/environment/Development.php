<?php

namespace AutomatedEmails\Original\Environment;

use AutomatedEmails\Original\Environment\Abilities\Environment;

class Development implements Environment
{
    public function isProduction(): bool
    {
        return false;
    } 

    public function isDevelopment(): bool
    {
        return true;   
    }

    public function isTesting(): bool
    {
        return false;
    } 
}