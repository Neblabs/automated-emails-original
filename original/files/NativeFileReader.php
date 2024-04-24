<?php

namespace AutomatedEmails\Original\Files;

use AutomatedEmails\Original\Abilities\FileReader;
use AutomatedEmails\Original\Abilities\ReadableFile;

class NativeFileReader implements FileReader
{
    public function read(ReadableFile $readableFile): mixed
    {
        ob_start();
        include $readableFile->source();
        return ob_get_clean();
    } 
}