<?php

namespace AutomatedEmails\App\Components\Exporters\Dashboard;

use AutomatedEmails\App\Components\Abilities\DashboardExportable;
use AutomatedEmails\App\Components\Abilities\DashboardExportableForPost;
use AutomatedEmails\App\Domain\Posts\Post;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use function AutomatedEmails\Original\Utilities\Collection\a;

abstract class DashboardExporterComposite implements DashboardExportableForPost
{
    public function __construct(
        protected Collection $dashboardExporters
    ) {}
    
    public function addExporter(DashboardExportable $dashboardExporter)
    {
        $this->dashboardExporters->push($dashboardExporter);
    }
    
    public function export(Post $post): array
    {
        // extra loaded data like category names when a condition has category ids and we dont send all the categories here but rather with jaavascript, so when seacrhing in the menu, an ajax call would be triggered and the names would be returned fine. Howvere, when its saved to the database and were loading the page a few days after, we'd only have the id in the app, se here we would print those categories ids that have been saved in the datase (for the inCategroies condition, for exaple)
        // in other words, consider that a post categories like this is saved in the database:
        // {
        //  permission: 'allowed',            
        //quantifier: 'all',
        // ids: [10, 34]
        // }
        // 
        // we'd pre-load here the category data (name, etc) for the ids: 10 and 34
        return $this->dashboardExporters->mapWithKeys(
            fn(DashboardExportable|DashboardExportableForPost $dashboardExporter) => a(
                key: $dashboardExporter->key(),
                value: $dashboardExporter->export($post)
            )
        )->asArray();
    } 
}