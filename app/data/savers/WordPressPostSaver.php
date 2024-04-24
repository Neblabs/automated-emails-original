<?php

namespace AutomatedEmails\App\Data\Savers;

use AutomatedEmails\App\Data\Savers\Abilities\Saveable;
use AutomatedEmails\App\Domain\Posts\Post;

abstract class WordPressPostSaver implements Saveable
{
    protected Post $post;

    public function setPost(Post $post) : void
    {
        $this->post = $post;
    }
}