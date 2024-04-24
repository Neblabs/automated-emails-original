<?php

namespace AutomatedEmails\App\Components\Exporters\Dashboard;

use AutomatedEmails\App\Components\Abilities\DashboardExportable;
use AutomatedEmails\Original\Environment\Env;

use function AutomatedEmails\Original\Utilities\Collection\a;

class FieldsToSaveExporter implements DashboardExportable
{
    public function key(): string
    {
        return 'fields';
    } 

    public function export(): array
    {
        return a(
            'automatedemails-event',
            'automatedemails-conditions_root',
            'automatedemails-recipients',
            'automatedemails-subject',
            'automatedemails-body',
            Env::getWithPrefix('dashboard_nonce'),
        );
    } 
}