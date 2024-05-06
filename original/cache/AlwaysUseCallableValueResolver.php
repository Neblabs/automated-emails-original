<?php

namespace AutomatedEmails\Original\Cache;

use AutomatedEmails\Original\Cache\Abilities\ValueResolver;

class AlwaysUseCallableValueResolver implements ValueResolver
{
    public function otherwise(callable $getter): mixed
    {
        return $getter();
    } 
}