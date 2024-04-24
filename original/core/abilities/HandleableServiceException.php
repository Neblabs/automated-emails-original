<?php

namespace AutomatedEmails\Original\Core\Abilities;

use Throwable;

interface HandleableServiceException
{
    public function handle(Throwable $exception, Service $service); 
}