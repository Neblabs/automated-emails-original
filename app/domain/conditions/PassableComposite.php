<?php

namespace AutomatedEmails\App\Domain\Conditions;

use AutomatedEmails\App\Domain\Conditions\Abilities\Passable;
use AutomatedEmails\Original\Abilities\GettableCollection;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Domain\Entity;

abstract class PassableComposite extends Entity implements Passable
{
    public function __construct(
        protected Collection/*<Passable>*/ $passable
    ) {}

    public function items() : Collection
    {
        return $this->passable;
    }

    public function add(GettableCollection $passableItems) : void
    {
        $this->passable->append($passableItems->get());
    }

    public function append(Passable $passable) : void
    {
        $this->passable->push($passable);
    }

    public function prepend(Passable $passable) : void
    {
        $this->passable->pushAtTheBeginning($passable);
    }
}