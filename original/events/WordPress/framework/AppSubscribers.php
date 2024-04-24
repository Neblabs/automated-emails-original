<?php

namespace AutomatedEmails\Original\Events\Wordpress\Framework;

use AutomatedEmails\Original\Abilities\ReadableFile;
use AutomatedEmails\Original\Environment\Env;

class AppSubscribers implements ReadableFile
{
    public function source(): string
    {
        return Env::appDirectory().'events/actions.php';
    } 
}