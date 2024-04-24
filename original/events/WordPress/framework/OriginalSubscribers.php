<?php

namespace AutomatedEmails\Original\Events\Wordpress\Framework;

use AutomatedEmails\Original\Abilities\ReadableFile;
use AutomatedEmails\Original\Environment\Env;

class OriginalSubscribers implements ReadableFile
{
    public function source(): string
    {
        return Env::originalDirectory().'subscribers/actions.php';
    } 
}