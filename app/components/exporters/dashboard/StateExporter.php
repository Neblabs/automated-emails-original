<?php

namespace AutomatedEmails\App\Components\Exporters\Dashboard;

class StateExporter extends DashboardExporterComposite
{
    public function key(): string
    {
        return 'state';
    } 
}