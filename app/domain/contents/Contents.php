<?php

namespace AutomatedEmails\App\Domain\Contents;

use AutomatedEmails\Original\Domain\Entities;

Class Contents extends Entities
{
    protected function getDomainClass() : string
    {
        return Content::class;
    }
}