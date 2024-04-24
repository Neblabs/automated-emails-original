<?php

namespace AutomatedEmails\Original\Dependency\Framework;

use AutomatedEmails\Original\Abilities\ReadableFile;
use AutomatedEmails\Original\Environment\Env;

class AppDependencyTypes implements ReadableFile
{
    public function source(): string
    {
        return Env::appDirectory().'dependencies/register.php';
    } 
}