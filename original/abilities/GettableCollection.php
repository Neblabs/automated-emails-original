<?php

namespace AutomatedEmails\Original\Abilities;

use AutomatedEmails\Original\Collections\Collection;

interface GettableCollection
{
    public function get() : Collection; 
}