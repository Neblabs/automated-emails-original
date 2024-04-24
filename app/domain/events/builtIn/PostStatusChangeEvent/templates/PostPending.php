<?php

namespace AutomatedEmails\App\Domain\Events\Builtin\PostStatusChangeEvent\Templates;

use AutomatedEmails\App\Components\Abilities\HasConditionsTemplate;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Events\Builtin\PostStatusChangeEvent\Templates\PostPendingComponent;
use AutomatedEmails\App\Domain\Events\PostStatusChange\PostStatusChange;
use AutomatedEmails\Original\Characters\StringManager;

class PostPending extends PostStatusChange
{
    protected function defaultConditionsTemplate(): StringManager
    {
        return $this->component()->template();
    } 

    /** @return Identifiable&HasConditionsTemplate */
    public function component(): Identifiable
    {
        return new PostPendingComponent;  
    } 
}
