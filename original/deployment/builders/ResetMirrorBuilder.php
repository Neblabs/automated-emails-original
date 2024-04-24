<?php

namespace AutomatedEmails\Original\Deployment\Builders;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Deployment\Directories\Directories;
use AutomatedEmails\Original\Deployment\Directories\File;
use AutomatedEmails\Original\Deployment\Files\Abilities\FileSystem;
use AutomatedEmails\Original\Deployment\Files\Files;
use AutomatedEmails\Original\Deployment\Files\FileVersions;
use AutomatedEmails\Original\Executable\Abilities\Executable;
use AutomatedEmails\Original\Executable\Abilities\Validatable;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;

class ResetMirrorBuilder implements Executable, Validatable
{
    public function __construct(
        protected Directories $directories,
        protected Files $files,
        protected FileSystem $filesystem
    ) {}
    
    public function canBeExecuted(): Validator
    {
        //mayeb obly if the console has that flag?
        return new PassingValidator;    
    } 

    public function execute()
    {
        print 'creating mirror files...';

        $this->filesystem->remove($this->directories->mirror()->get());

        $this->files->allSourceFilesToCopy()->forEvery(function(FileVersions $fileVersions) {
            $this->filesystem->copy(
                originFile: $fileVersions->source()->absolutePath(),
                targetFile: $fileVersions->mirror()->absolutePath()
            );
        });
    } 
}