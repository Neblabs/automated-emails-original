<?php

namespace AutomatedEmails\Original\Construction\Abilities;

use AutomatedEmails\Original\Collections\Collection;

interface CreatableContainers
{
    public function create() : Collection; 
}