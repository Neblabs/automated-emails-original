<?php

namespace AutomatedEmails\Original\Deployment\Transformers\Abilities;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Deployment\Files\FileVersions;
use AutomatedEmails\Original\Validation\Validator;

interface ValidatableTransformable
{
    public function canBeTransformed(StringManager $fileContents, FileVersions $fileVersions) : Validator;
}