<?php

namespace AutomatedEmails\App\Data\Savers\Exporters\State;

use AutomatedEmails\App\Components\Abilities\DashboardExportableForPost;
use AutomatedEmails\App\Data\Finders\ConditionsRoot\ConditionsRootStructure;
use AutomatedEmails\App\Domain\Posts\Post;

use function AutomatedEmails\Original\Utilities\Collection\_;

class ConditionsRootExporter implements DashboardExportableForPost
{
    public function __construct(
        protected ConditionsRootStructure $conditionsRootStructure
    ) {}
    
    public function key(): string
    {
        return 'conditionsRoot';
    } 

    public function export(Post $post): string
    {
        (string) $conditionsRootSource = get_post_meta(
            post_id: $post->id(),
            key: $this->conditionsRootStructure->fields()->id()->id()->get(),
            single: true
        );

        if (is_object(json_decode($conditionsRootSource))) {
            return $conditionsRootSource;
        }

        return _(
            type: 'none',
            subjectConditions: [
            ]
        )->asJson();
    } 
}