<?php

namespace AutomatedEmails\App\Data\Savers\Exporters\State;

use AutomatedEmails\App\Components\Abilities\DashboardExportableForPost;
use AutomatedEmails\App\Data\Finders\Recipients\RecipientStructure;
use AutomatedEmails\App\Domain\Posts\Post;

use function AutomatedEmails\Original\Utilities\Collection\_;

class RecipientsExporter implements DashboardExportableForPost
{
    public function __construct(
        protected RecipientStructure $recipientStructure
    ) {}
    
    public function key(): string
    {
        return 'recipients';
    } 

    public function export(Post $post): array
    {
        return _(get_post_meta(
            post_id: $post->id(),
            key: $this->recipientStructure->fields()->id()->id()->get(),
            single: false
        ))->map(fn(string $baseRecipinet) => json_decode($baseRecipinet)->email)->asArray();
    } 
}