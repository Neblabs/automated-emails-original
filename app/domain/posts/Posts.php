<?php

namespace AutomatedEmails\App\Domain\Posts;

use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\App\Domain\Posts\Posts;

Class Posts extends Entities
{
    protected function getDomainClass() : string
    {
        return Post::class;
    }
}