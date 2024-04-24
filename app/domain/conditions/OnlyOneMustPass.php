<?php

namespace AutomatedEmails\App\Domain\Conditions;

use AutomatedEmails\App\Domain\Conditions\Abilities\Passable;

class OnlyOneMustPass extends PassableComposite
{
    public function passes(): bool
    {
        return $this->passable->haveAny() && 
               $this->passable->have(fn(Passable $passable) => $passable->passes());
    } 
}