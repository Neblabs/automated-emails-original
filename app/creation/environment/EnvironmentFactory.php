<?php

namespace AutomatedEmails\App\Creation\Environment;

use AutomatedEmails\Original\Environment\Abilities\Environment;
use AutomatedEmails\Original\Environment\Development;
use AutomatedEmails\Original\Environment\Production;

class EnvironmentFactory
{
    public function create(string $environment) : Environment
    {
        return match($environment) {
            'development' => new Development,
            default => new Production
        };
    }
}