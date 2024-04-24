<?php

namespace AutomatedEmails\App\Tasks;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Tasks\Task;

Class PHPLinterTask extends Task
{
    public function run(Collection $taskData)
    {
        (string) $php = Env::settings()->binaries->php;
        (string) $file = $taskData->get('filePath');
        (string) $comand = "{$php} ./vendor/bin/parallel-lint {$file} --colors --no-progress";

        echo "\t".(implode("\n\t", explode("\n", shell_exec($comand))));

    }
}