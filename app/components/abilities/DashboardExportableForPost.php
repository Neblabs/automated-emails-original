<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\App\Domain\Posts\Post;
use AutomatedEmails\Original\Characters\StringManager;

interface DashboardExportableForPost extends ExportableForPost
{
    public function key() : string; 
    public function export(Post $post) : array|StringManager|string|bool|int|float;
}