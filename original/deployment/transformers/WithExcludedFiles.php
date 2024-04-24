<?php

namespace AutomatedEmails\Original\Deployment\Transformers;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Deployment\Files\FileVersions;
use AutomatedEmails\Original\Deployment\Transformers\Abilities\IsDecorator;
use AutomatedEmails\Original\Deployment\Transformers\Abilities\Transformable;
use AutomatedEmails\Original\Deployment\Transformers\Abilities\ValidatableTransformable;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;

use function AutomatedEmails\Original\Utilities\Text\i;

class WithExcludedFiles implements Transformable, ValidatableTransformable, IsDecorator
{
    public function __construct(
        protected Transformable $transformer,
        protected Collection $relativeExcludedFilePaths
    ) {}
    
    public function canBeTransformed(StringManager $fileContents, FileVersions $fileVersions): Validator
    {
        return new ValidWhen(
            $fileVersions->source()->relativePath()->isNotEither($this->relativeExcludedFilePaths)
        );
    } 

    public function transform(StringManager $fileContents, FileVersions $fileVersions): StringManager
    {
        return $this->transformer->transform($fileContents, $fileVersions);
    } 

    public function decorated(): Transformable
    {
        return $this->transformer;
    } 
}