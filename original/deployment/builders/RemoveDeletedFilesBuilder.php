<?php

namespace AutomatedEmails\Original\Deployment\Builders;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Deployment\Directories\Directories;
use AutomatedEmails\Original\Deployment\Directories\File;
use AutomatedEmails\Original\Deployment\Files\Abilities\FileSystem;
use AutomatedEmails\Original\Deployment\Files\Files;
use AutomatedEmails\Original\Deployment\Files\FileVersions;
use AutomatedEmails\Original\Executable\Abilities\Executable;

class RemoveDeletedFilesBuilder implements Executable
{
    public function __construct(
        protected Directories $directories,
        protected Files $files,
        protected FileSystem $filesystem
    ) {}
    
    public function execute()
    {
        print 'removing deleted files...';

        foreach ($this->files->deleted->asArray() as $fileVersions) {
            $this->filesystem->remove($fileVersions->mirror()->absolutePath()); 
        }
    } 
}