<?php

namespace AutomatedEmails\App\Data\Savers;

use AutomatedEmails\App\Data\Savers\Abilities\KeyValueSaveableDataProvider;
use AutomatedEmails\App\Domain\Posts\Post;

abstract class WordPressPostMetaSaverDataProvider implements KeyValueSaveableDataProvider
{
    protected Post $post;

    public function setPost(Post $post) 
    {
        $this->post = $post;
    }
}