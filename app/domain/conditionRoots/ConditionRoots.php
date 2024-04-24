<?php

namespace AutomatedEmails\App\Domain\ConditionRoots;

use AutomatedEmails\App\Domain\Conditions\Abilities\Passable;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Domain\ExtendableEntities;

Class ConditionRoots extends ExtendableEntities implements Passable
{
    protected ?ConditionsRoot $defaultConditionsRoot = null;

    public function setDefaultConditionsRoot(ConditionsRoot $conditionsRoot) : void
    {
        $this->defaultConditionsRoot = $conditionsRoot;
    }

    public function defaultConditionsRoot() : ?ConditionsRoot
    {
        return $this->defaultConditionsRoot;
    }
    
    public function customConditionRoots() : Collection
    {
        return $this->asCollection();
    }

    public function passes(): bool
    {
        return $this->defaultConditionsRootPasses() && $this->entities->allPass(passes: null);
    } 

    protected function defaultConditionsRootPasses() : bool
    {
        if (!$this->defaultConditionsRoot instanceof ConditionsRoot) {
            return true;
        }

        return $this->defaultConditionsRoot->passes();
    }

    protected function getDomainClass() : string
    {
        return ConditionsRoot::class;
    }
}