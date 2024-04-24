<?php

namespace AutomatedEmails\Original\Core\Services;

use AutomatedEmails\Original\Abilities\ReadableFile;
use AutomatedEmails\Original\Environment\Env;

class RegisteredAppServices implements ReadableFile
{
    public function source(): string
    {
        return Env::appDirectory().'services/services.php';
    } 
}