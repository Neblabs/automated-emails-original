<?php

namespace AutomatedEmails\Original\Collections;

use AutomatedEmails\Original\Abilities\FileReader;
use AutomatedEmails\Original\Abilities\GettableCollection;
use AutomatedEmails\Original\Abilities\ReadableFile;
use AutomatedEmails\Original\Files\RequireFileReader;
use AutomatedEmails\Original\Files\RequireOnceFileReader;

use function AutomatedEmails\Original\Utilities\Collection\_;

class ByFileGettableCollection implements GettableCollection
{
    public function __construct(
        protected ReadableFile $registeredItemsFile,
        protected FileReader $fileReader = new RequireFileReader
    ) {}
    
    public function get(): Collection
    {
        return _(...$this->fileReader->read(
            $this->registeredItemsFile
        ));
    } 
}