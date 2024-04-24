<?php

namespace AutomatedEmails\Original\Construction\Abilities;

use AutomatedEmails\Original\Dependency\Container;
use AutomatedEmails\Original\Dependency\Dependency;

interface ContainerFactory
{
    public function create(string|Dependency $dependency) : Container;
}