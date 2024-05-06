<?php

namespace AutomatedEmails\Original\Cache\Abilities;

interface ValueResolver
{
    public function otherwise(callable $getter) : mixed;
}