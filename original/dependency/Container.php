<?php

namespace AutomatedEmails\Original\Dependency;

use AutomatedEmails\Original\Dependency\Abilities\Context;

interface Container
{
    public function matches(string $type, Context $context) : bool;
    public function get(string $type) : object;
    public function setDependenciesContainer(DependenciesContainer $dependenciesContainer) : void; 
}