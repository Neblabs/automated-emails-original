<?php

namespace AutomatedEmails\Original\Deployment\Transformers;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Deployment\Files\FileVersions;
use AutomatedEmails\Original\Deployment\Transformers\Abilities\IsDecorator;
use AutomatedEmails\Original\Deployment\Transformers\Abilities\Transformable;
use AutomatedEmails\Original\Deployment\Transformers\Abilities\ValidatableTransformable;
use AutomatedEmails\Original\Validation\Validator;

use function AutomatedEmails\Original\Utilities\Text\i;

class ConditionalTransformer implements Transformable, ValidatableTransformable, IsDecorator
{
    public function __construct(
        protected Transformable $transformer,
        protected ValidatableTransformable $transformerValidator
    ) {}
    
    public function canBeTransformed(StringManager $fileContents, FileVersions $fileVersions): Validator
    {
        return $this->transformerValidator->canBeTransformed($fileContents, $fileVersions);
    } 

    public function transform(StringManager $fileContents, FileVersions $fileVersions): StringManager
    {
        if (!$this->canBeTransformed($fileContents, $fileVersions)->isValid()) {
            return $fileContents;
        }

        return $this->transformer->transform($fileContents, $fileVersions);
    } 

    public function decorated(): Transformable
    {
        return $this->transformer;
    } 
}