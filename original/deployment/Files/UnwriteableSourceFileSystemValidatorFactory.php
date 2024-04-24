<?php

namespace AutomatedEmails\Original\Deployment\Files;

use AutomatedEmails\Original\Deployment\Directories\Directories;
use AutomatedEmails\Original\Deployment\Files\Abilities\FileSystemValidatorFactory;
use AutomatedEmails\Original\Deployment\Files\Exceptions\UnwriteableSourceException;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;
use Exception;

use function AutomatedEmails\Original\Utilities\Text\i;
use function AutomatedEmails\Original\Utilities\Collection\_;

class UnwriteableSourceFileSystemValidatorFactory implements FileSystemValidatorFactory
{
    public function __construct(
        protected Directories $directories
    ) {}
    
    public function copy($originFile, $targetFile) : Validator
    {
        return $this->isNotInTargetDirectory($targetFile);
    }

    public function remove($files) : Validator
    {
        return new Validators(_($files)->map($this->isNotInTargetDirectory(...)));
    } 

    public function rename($origin, $target, $overwrite = false) : Validator
    {
        return $this->isNotInTargetDirectory($target);
    } 

    protected function isNotInTargetDirectory($targetFile) : Validator
    {
        return new ValidWhen(
            !i($targetFile)->contains($this->directories->source(), caseSensitive: false),
            exception: new UnwriteableSourceException("Trying to write to the source: {$targetFile}")
        );
    }
    
}