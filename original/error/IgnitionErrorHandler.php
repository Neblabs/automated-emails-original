<?php

namespace AutomatedEmails\Original\Error;

use AutomatedEmails\Original\Error\Abilities\GlobalErrorHandler;

use Spatie\Ignition\Ignition;

class IgnitionErrorHandler implements GlobalErrorHandler
{
    public function register(): void
    {
        Ignition::make()->useDarkMode()->register();
    } 
}