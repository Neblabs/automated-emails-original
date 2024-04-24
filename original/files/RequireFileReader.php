<?php

namespace AutomatedEmails\Original\Files;

use AutomatedEmails\Original\Abilities\FileReader;
use AutomatedEmails\Original\Abilities\ReadableFile;
use AutomatedEmails\Original\Cache\Cache;
use AutomatedEmails\Original\Cache\MemoryCache;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Environment\Env;
use Error;
use Exception;
use Throwable;
use function AutomatedEmails\Original\Utilities\Text\i;

class RequireFileReader implements FileReader
{
    public function __construct(
        protected Cache $cache = new MemoryCache
    ) {}
    
    public function read(ReadableFile $readableFile): mixed
    {
        return $this->cache->getIfExists('contents')->otherwise(
            function() use($readableFile) {
                try {
                    //php 72...
                    if (!file_exists($readableFile->source())) {
                        throw  new \Exception("File not found: {$readableFile->source()}");
                    }
                    return require $readableFile->source();
                } catch (Throwable $error) {
                    return require $this->relativePathLowercased($readableFile->source());
                }
            }
        );
    } 

    protected function relativePathLowercased(string $source) : string
    {
        // get the relative path 
        // lowercase it
        // then return the full path
        (string) $classNameWithNoMasterNamespace = substr(
            $source, 
            (strlen(Env::id()) + 1)
        );

        return strtolower(str_replace('\\', '/', $classNameWithNoMasterNamespace));
    }
    
}