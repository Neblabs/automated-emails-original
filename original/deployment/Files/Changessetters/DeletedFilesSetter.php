<?php

namespace AutomatedEmails\Original\Deployment\Files\Changessetters;

use AutomatedEmails\Original\Deployment\Files\Files;
use AutomatedEmails\Original\Deployment\Files\FileVersions;
use AutomatedEmails\Original\Executable\Abilities\Executable;

class DeletedFilesSetter implements Executable
{
    public function __construct(
        protected Files $files
    ) {}
    
    public function execute()
    {
        $this->files->allMirrorFiles()->forEvery(function(FileVersions $mirrorFileVersions) {
            // we're getting the "source" version of the mirror file
            if (!$mirrorFileVersions->source()->info()->isFile()) {
                $this->files->deleted->push($mirrorFileVersions);
            }
        }); 
    } 
}