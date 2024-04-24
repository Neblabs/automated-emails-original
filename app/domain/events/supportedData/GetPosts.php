<?php

namespace AutomatedEmails\App\Domain\Events\Supporteddata;

use AutomatedEmails\App\Domain\Data\Post\PostDataType;
use AutomatedEmails\App\Domain\Data\Post\PostsData;

trait GetPosts
{
    public function postsData() : PostsData
    {
        return $this->dataSet($this->postsDataType()->id());
    }

    public function postsDataType() : PostDataType
    {
        return new PostDataType;
    }
}