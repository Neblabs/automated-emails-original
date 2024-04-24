<?php

namespace AutomatedEmails\Original\Deployment\Transformers\Attributes;

use Attribute;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Deployment\Files\FileVersions;
use AutomatedEmails\Original\Deployment\Transformers\Abilities\ValidatableTransformable;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;

use function AutomatedEmails\Original\Utilities\Collection\_;

#[Attribute]
class OnlyExtensions implements ValidatableTransformable
{
    protected Collection $extensions;

    public function __construct(
        array $extensions
    ) {
        $this->extensions = _($extensions);
    }
    
    public function canBeTransformed(StringManager $fileContents, FileVersions $fileVersions): Validator
    {
        // here we make sure its not part of the excluded files
        return new ValidWhen(
            $this->extensions->have($fileVersions->source()->relativePath()->endsWith(...))
        );
    } 
}