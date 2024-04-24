<?php

namespace AutomatedEmails\App\Domain\Conditions\Abilities;

interface Passable
{
    public function passes() : bool; 
}