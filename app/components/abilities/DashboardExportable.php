<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\Original\Characters\StringManager;

interface DashboardExportable extends Exportable
{
    public function key() : string; 
    public function export() : array|StringManager|string|bool|int|float;
}