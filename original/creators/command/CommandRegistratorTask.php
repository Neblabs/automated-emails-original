<?php

namespace AutomatedEmails\Original\Creators\Command;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Tasks\Task;

Class CommandRegistratorTask extends Task
{
    public function run(Collection $taskData)
    {
        $this->taskData = $taskData;

        (array) $registeredEventsFile = file_get_contents($this->getRegisterFile());

        (string) $fileWithUpdatedArray = $this->getWithNewEntryInArray($registeredEventsFile);

        $this->updateFile(
            $fileWithUpdatedArray
        );

        $this->updateFile(
            $this->getWithNamespaceAdded($fileWithUpdatedArray)
        );
    }

    protected function getWithNewEntryInArray(string $registerFileContent) : string
    {
        return preg_replace('/\,\s+(\]\;)/', ",\n    {$this->taskData->get('className')}::class,\n];", $registerFileContent);;
    }

    protected function getWithNamespaceAdded(string $registerFileContent) : string
    {
        return preg_replace('/\nreturn /', "use {$this->taskData->get('fullyQualifiedClassName')};\n\nreturn ", $registerFileContent);;
    }

    protected function updateFile(string $content)
    {
        file_put_contents(
            $this->getRegisterFile(),
            $content
        );   
    }
    

    protected function getRegisterFile() : string
    {
        (string) $base = Env::directory().'original/commands';

        if ($this->taskData->get('createInAppDirectory')) {
            (string) $base = Env::directory().'app/commands';
        }

        return "{$base}/register.php";
    }
    
}