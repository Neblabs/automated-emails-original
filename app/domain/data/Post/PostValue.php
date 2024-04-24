<?php

namespace AutomatedEmails\App\Domain\Data\Post;

use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\App\Domain\Data\Post\PostData;
use AutomatedEmails\App\Domain\Data\DataValue;
use AutomatedEmails\Original\System\Functions\GlobalFunctionWrapper;
use WP_Post;

Abstract Class PostValue extends DataValue
{
    public function __construct(
        protected PostData $postData,
        protected GlobalFunctionWrapper $globalFunctionWrapper = new GlobalFunctionWrapper
    ) {}

    public function data(): Data
    {
        return $this->postData;
    }

    protected function classicPost() : WP_Post
    {
        return $this->postData->post()->classic();   
    }
}