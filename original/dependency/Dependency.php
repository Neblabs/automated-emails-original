<?php

namespace AutomatedEmails\Original\Dependency;

use AutomatedEmails\Original\Dependency\Abilities\Context;

interface Dependency
{
    public function create() : object;
    public function canBeCreated(Context $context) : bool;
}