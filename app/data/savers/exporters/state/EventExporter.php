<?php

namespace AutomatedEmails\App\Data\Savers\Exporters\State;

use AutomatedEmails\App\Components\Abilities\DashboardExportableForPost;
use AutomatedEmails\App\Data\Finders\Events\EventStructure;
use AutomatedEmails\App\Domain\Posts\Post;

class EventExporter implements DashboardExportableForPost
{
    public function __construct(
        protected EventStructure $eventStructure
    ) {}
    
    public function key(): string
    {
        return 'event';
    } 

    public function export(Post $post): string
    {
        return get_post_meta(
            post_id: $post->id(),
            key: $this->eventStructure->fields()->id()->id()->get(),
            single: true
        );
    } 
}