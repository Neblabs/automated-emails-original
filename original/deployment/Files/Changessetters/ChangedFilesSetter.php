<?php

namespace AutomatedEmails\Original\Deployment\Files\Changessetters;

use AutomatedEmails\Original\Deployment\Files\Files;
use AutomatedEmails\Original\Deployment\Files\FileVersions;
use AutomatedEmails\Original\Executable\Abilities\Executable;

class ChangedFilesSetter implements Executable
{
    public function __construct(
        protected Files $files
    ) {}
    
    public function execute()
    {
        $this->files->allSourceFilesToCopy()->forEvery(function(FileVersions $file) {
            if ($file->source()->relativePath()->startsWith('vendor')) {
                return;
            }

            if ($this->files->deleted->have(fn(FileVersions $deletedFile) => $deletedFile->source()->relativePath()->is($file->source()->relativePath()))) {
                return;
            }

            (string) $sourceFileContent = file_get_contents($file->source()->absolutePath());
            (string) $mirrorFileContent = file_get_contents($file->mirror()->absolutePath());

            if ($sourceFileContent != $mirrorFileContent) {
                $this->files->changed->push($file);
            }
        }); 
    } 
}