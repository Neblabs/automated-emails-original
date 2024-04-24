<?php

namespace AutomatedEmails\Original\Dependency\Framework;

use AutomatedEmails\Original\Abilities\ReadableFile;
use AutomatedEmails\Original\Environment\Env;

class OriginalDependencyTypes implements ReadableFile
{
    public function source(): string
    {
        return Env::originalDirectory().'dependency/builtin/dependencies.php';
    } 
}