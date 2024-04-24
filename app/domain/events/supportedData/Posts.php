<?php

namespace AutomatedEmails\App\Domain\Events\SupportedData;

use AutomatedEmails\App\Domain\Data\Post\PostDataType;
use AutomatedEmails\App\Domain\Data\Post\PostsData;

/**
 * Expects a protected posts() method to be implemented
 */
interface Posts extends EventDataSet
{
    public function postsData() : PostsData;
    public function postsDataType() : PostDataType;
}