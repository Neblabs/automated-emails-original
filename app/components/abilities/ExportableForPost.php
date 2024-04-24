<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\App\Domain\Posts\Post;

interface ExportableForPost
{
    public function export(Post $post) : mixed; 
}