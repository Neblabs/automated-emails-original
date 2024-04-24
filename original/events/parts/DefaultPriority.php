<?php

namespace AutomatedEmails\Original\Events\Parts;

Trait DefaultPriority
{
    public function priority() : int
    {
        return 10;   
    }
}