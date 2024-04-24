<?php

namespace AutomatedEmails\App\Domain\Conditions;

use AutomatedEmails\App\Domain\Conditions\Abilities\Passable;
use AutomatedEmails\Original\Collections\Collection;

class AllMustPass extends PassableComposite
{
    public function passes(): bool
    {
        return $this->passable->haveAny() && 
               $this->passable->doesNotHave(fn(Passable $passable) => !$passable->passes());
    } 
}