<?php

namespace AutomatedEmails\Original\Construction\Abilities;

use AutomatedEmails\Original\Core\Abilities\HandleableServiceException;

interface HandleableServiceExceptionFactory
{
    public function create() : HandleableServiceException; 
}