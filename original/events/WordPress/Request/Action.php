<?php

namespace AutomatedEmails\Original\Events\Wordpress\Request;

use AutomatedEmails\Original\Events\Wordpress;

Class Action extends Hook
{
    public function type(): string
    {
        return Wordpress\Action::class;
    }
}