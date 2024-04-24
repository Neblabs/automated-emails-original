<?php

namespace AutomatedEmails\Original\Events\Wordpress\Request;

use AutomatedEmails\Original\Events\Wordpress;

Class Filter extends Hook
{
    public function type(): string
    {
        return Wordpress\Filter::class;
    }
}