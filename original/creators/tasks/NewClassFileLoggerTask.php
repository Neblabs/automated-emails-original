<?php

namespace AutomatedEmails\Original\Creators\Tasks;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Loggers\NewClassFileLogger;
use AutomatedEmails\Original\Tasks\Task;

Class NewClassFileLoggerTask extends Task
{
    public function run(Collection $taskData)
    {
        (object) $consoleLogger = new NewClassFileLogger(
            $absoluteFilePath = $taskData->get('filePath'),
            $baseClassName = $taskData->get('baseClassName'),
            $className = $taskData->get('className')
        );

        $consoleLogger->log();
    }
}