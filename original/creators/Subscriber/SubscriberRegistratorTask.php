<?php

namespace AutomatedEmails\Original\Creators\Subscriber;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Tasks\Task;

Class SubscriberRegistratorTask extends Task
{
    protected Collection $taskData;

    public function __construct(
        protected string $hookName
    ) {}
    
    public function run(Collection $taskData)
    {
        (string) $eventsFile = $this->getFileName($taskData);
        (array) $registeredEvents = require $eventsFile;
        (string) $className = ucfirst($taskData->get('className'));

        $registeredEvents[$this->hookName][] = $taskData->get('fullyQualifiedClassName');

        (string) $newArray = $this->varexport($registeredEvents);

        $newArray = preg_replace("/([0-9]+\s+=>\s+)/", '', $newArray);

        file_put_contents($eventsFile, "<?php\n\nreturn {$newArray};");
    }

    protected function getFileName(Collection $taskData) : string
    {
        return match($taskData->get('createInOriginalDirectory')) {
            true => Env::originalDirectory().'subscribers/actions.php',
            false => Env::appDirectory().'events/actions.php'
        };
    }

    protected function varexport($expression, $return=true, $indent=4) {
        $object = json_decode(str_replace(['(', ')'], ['&#40', '&#41'], json_encode($expression)), TRUE);
        $export = str_replace(['array (', ')', '&#40', '&#41'], ['[', ']', '(', ')'], var_export($object, TRUE));
        $export = preg_replace("/ => \n[^\S\n]*\[/m", ' => [', $export);
        $export = preg_replace("/ => \[\n[^\S\n]*\]/m", ' => []', $export);
        $spaces = str_repeat(' ', $indent);
        $export = preg_replace("/([ ]{2})(?![^ ])/m", $spaces, $export);
        $export = preg_replace("/^([ ]{2})/m", $spaces, $export);
        if ((bool)$return) return $export; else echo $export;
    }
}