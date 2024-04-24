<?php

namespace AutomatedEmails\Original\Deployment\Transformers\Attributes;

use Attribute;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Deployment\Files\FileVersions;
use AutomatedEmails\Original\Deployment\Transformers\Abilities\ValidatableTransformable;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;


#[Attribute]
class NotVendor implements ValidatableTransformable
{
    public function canBeTransformed(StringManager $fileContents, FileVersions $fileVersions): Validator
    {
        // here we make sure its not part of the excluded files
        return new ValidWhen(
            !$fileVersions->source()->relativePath()->contains('vendor/')
        );
    } 
}