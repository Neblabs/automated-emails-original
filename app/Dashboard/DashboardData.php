<?php

namespace AutomatedEmails\App\Dashboard;

use AutomatedEmails\App\Components\Exporters\Dashboard\DashboardExporterComposite;
use AutomatedEmails\App\Domain\Posts\Post;

use function AutomatedEmails\Original\Utilities\Text\i;

class DashboardData extends DashboardExporterComposite
{
    public function key(): string
    {
        return 'AutomatedEmails';
    } 

    public function export(Post $post): array
    {
        // this will trigger the jsonserializable on StringManager and Collection instances
        return json_decode(wp_json_encode(parent::export($post)), flags: JSON_OBJECT_AS_ARRAY); 
    } 
}