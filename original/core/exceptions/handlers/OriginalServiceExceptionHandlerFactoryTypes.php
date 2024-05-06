<?php

namespace AutomatedEmails\Original\Core\Exceptions\Handlers;

use AutomatedEmails\Original\Abilities\ReadableFile;
use AutomatedEmails\Original\Environment\Env;

class OriginalServiceExceptionHandlerFactoryTypes implements ReadableFile
{
    public function source(): string
    {
        return Env::originalDirectory().'/core/exceptions/handlers/register.php';
    } 
}