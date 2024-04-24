<?php

namespace AutomatedEmails\App\Components\Exporters\Dashboard;

use AutomatedEmails\App\Components\Abilities\DashboardExportable;
use AutomatedEmails\App\Components\Exporters\Dashboard\DashboardExporterComposite;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use function AutomatedEmails\Original\Utilities\Collection\_;

class DashboardComponentsExporter extends DashboardExporterComposite
{
    public function key(): string
    {
        return 'components';
    } 
}