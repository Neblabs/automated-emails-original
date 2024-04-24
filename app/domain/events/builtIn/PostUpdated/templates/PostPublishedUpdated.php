<?php

namespace AutomatedEmails\App\Domain\Events\Builtin\PostUpdated\Templates;

use AutomatedEmails\App\Components\Abilities\HasConditionsTemplate;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Events\Builtin\PostUpdated\Templates\PostPublishedUpdatedComponent;
use AutomatedEmails\App\Domain\Events\Builtin\PostUpdated\PostUpdated;
use AutomatedEmails\Original\Characters\StringManager;

class PostPublishedUpdated extends PostUpdated
{
    protected function defaultConditionsTemplate(): StringManager
    {
        return $this->component()->template();
    } 

    /** @return Identifiable&HasConditionsTemplate */
    public function component(): Identifiable
    {
        return new PostPublishedUpdatedComponent;  
    } 
}
