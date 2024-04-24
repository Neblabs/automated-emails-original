<?php

namespace AutomatedEmails\App\Domain\Data\Post;

use AutomatedEmails\App\Creation\Values\PostValuesFactory;
use AutomatedEmails\App\Creation\DataValuesFactory;
use AutomatedEmails\App\Domain\Data\Post\Values\PostTitle;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\App\Domain\Data\DataType;
use AutomatedEmails\App\Domain\Data\Post\PostDataType;
use AutomatedEmails\App\Domain\Data\Post\PostValues;
use AutomatedEmails\App\Domain\Posts\Post;

Class PostData extends Data
{
    private Post $post;

    protected function setEntity(mixed $entity) : void
    {
        $this->post = $entity;
    }

    public function type(): DataType
    {
        return new PostDataType;  
    } 

    protected function valuesFactory() : PostValuesFactory
    {
        return new PostValuesFactory($this);
    }

    public function post() : Post
    {
        return $this->post;
    }

    public function entity() : Post
    {
        return $this->post();
    }
}