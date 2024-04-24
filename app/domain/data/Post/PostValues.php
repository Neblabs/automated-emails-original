<?php

namespace AutomatedEmails\App\Domain\Data\Post;

use AutomatedEmails\App\Domain\Data\DataValues;
use AutomatedEmails\App\Domain\Data\Post\PostValue;
use AutomatedEmails\Original\Domain\Entities;

Class PostValues extends DataValues
{
    protected function getDomainClass() : string
    {
        return PostValue::class;
    }
}