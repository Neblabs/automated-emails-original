<?php

namespace AutomatedEmails\Original\Deployment\Transformers\Abilities;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Deployment\Files\FileVersions;

interface Transformable
{
    public function transform(StringManager $fileContents, FileVersions $fileVersions) : StringManager;
}