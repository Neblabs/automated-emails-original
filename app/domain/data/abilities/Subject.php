<?php

namespace AutomatedEmails\App\Domain\Data\Abilities;

use AutomatedEmails\App\Domain\Data\Data;

interface Subject
{
    public function get() : Data; 
}