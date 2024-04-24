<?php

namespace AutomatedEmails\App\Components\Exporters\Dashboard;

use AutomatedEmails\App\Components\Abilities\DashboardExportable;
use AutomatedEmails\Original\Environment\Env;
use function AutomatedEmails\Original\Utilities\Collection\a;

class NoncesExporter implements DashboardExportable
{
    public function key(): string
    {
        return 'security';
    } 

    public function export(): array
    {
        return a(
            nonce: a(
                id: $id = Env::getWithPrefix('dashboard_nonce'),
                value: wp_create_nonce($id)
            )
        );
    } 
}