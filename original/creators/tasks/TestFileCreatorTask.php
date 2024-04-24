<?php

namespace AutomatedEmails\Original\Creators\Tasks;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\Test\TestFileCreator;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Tasks\Task;

Class TestFileCreatorTask extends Task
{
    public function __construct(
        protected string $customTemplatePathAbsolute = '',
        protected string $baseTargetDirectory = ''
    ) {}
    
    public function run(Collection $taskData)
    {
        (object) $testFileCreator = new TestFileCreator(
            $taskData->get('filePath'), 
            $taskData->get('testGroup'),
            $taskData,
            $this->customTemplatePathAbsolute,
            $this->baseTargetDirectory
        );

        $testFileCreator->create();
    }
}