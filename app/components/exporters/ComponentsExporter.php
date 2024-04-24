<?php

namespace AutomatedEmails\App\Components\Exporters;

use AutomatedEmails\App\Components\Abilities\DashboardExportable;
use AutomatedEmails\App\Components\Components;

abstract class ComponentsExporter implements DashboardExportable
{
    public function __construct(
        protected Components $components
    ) {}
    
}