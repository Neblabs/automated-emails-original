<?php

namespace AutomatedEmails\Original\Deployment\Directories;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use SplFileInfo;

use function AutomatedEmails\Original\Utilities\Text\i;

class Directories
{
    public function __construct(
        protected object $userDefinedDirectories
    ) {}
    
    public function repository() : StringManager
    {
        return i($this->userDefinedDirectories->development->repository);
    }

    public function mirror() : StringManager
    {
        return i("{$this->repository()}/mirror/{$this->userDefinedDirectories->main}");
    }

    public function source() : StringManager
    {
        return i(getcwd());
    }
}