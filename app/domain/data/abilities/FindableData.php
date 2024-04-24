<?php

namespace AutomatedEmails\App\Domain\Data\Abilities;

use AutomatedEmails\App\Domain\Data\Data;

interface FindableData
{
    public function withId(mixed $id) : Data;
}