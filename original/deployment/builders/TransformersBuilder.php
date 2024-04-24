<?php

namespace AutomatedEmails\Original\Deployment\Builders;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Deployment\Transformers\Abilities\Transformable;
use AutomatedEmails\Original\Deployment\Directories\Directories;
use AutomatedEmails\Original\Deployment\Files\Abilities\FileSystem;
use AutomatedEmails\Original\Deployment\Files\Files;
use AutomatedEmails\Original\Deployment\Files\FileVersions;
use AutomatedEmails\Original\Executable\Abilities\Executable;
use AutomatedEmails\Original\Executable\Abilities\Validatable;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;

use function AutomatedEmails\Original\Utilities\Text\i;

class TransformersBuilder implements Executable, Validatable
{
    public function __construct(
        protected Directories $directories,
        protected Files $files,
        protected FileSystem $filesystem,
        protected Collection $transformers
    ) {}
    
    public function canBeExecuted(): Validator
    {
        //mayeb obly if the console has that flag?
        return new PassingValidator;    
    } 

    public function execute()
    {
        print 'running transformer scripts...';

        $this->files->changed->forEvery(function(FileVersions $fileVersions) {
            (object) $transformedFileContent = $this->transformers->reduce(
                fn(StringManager $fileContents, Transformable $transformer) => $transformer->transform(
                    $fileContents, 
                    $fileVersions
                ), 
                initial: i(file_get_contents($fileVersions->source()->absolutePath()))
            );

            // and after all, we'll upadte the contents to the trasnformed file in transformed/fielname.php 
            dd('updating', (string) $transformedFileContent);
        }); 
    } 
}