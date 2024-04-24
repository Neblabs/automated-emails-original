<?php

namespace AutomatedEmails\App\Components\Exporters\Dashboard;

use AutomatedEmails\App\Components\Abilities\DashboardExportable;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Environment\Env;

use function AutomatedEmails\Original\Utilities\Collection\_;

class TextDomainExporter implements DashboardExportable
{
    public function key(): string
    {
        return 'textDomain';
    } 

    public function export(): string
    {
        return Env::textDomain();
    } 
}