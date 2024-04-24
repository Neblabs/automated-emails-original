<?php

namespace AutomatedEmails\Original\Creators;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\Abilities\Creator;

Abstract Class Creators implements Creator
{
    abstract protected function getCreators() : Collection;

    public function create()
    {
        foreach ($this->getCreators() as $creator) {
            $creator->create();
        }
    }
}