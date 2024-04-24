<?php

namespace AutomatedEmails\App\Data\Savers\Exporters\State;

use AutomatedEmails\App\Components\Abilities\DashboardExportableForPost;
use AutomatedEmails\App\Domain\Posts\Post;

class SubjectExporter implements DashboardExportableForPost
{
    public function key(): string
    {
        return 'subject';
    } 

    public function export(Post $post): string
    {
        return $post->titleRaw();
    } 
}