<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\Original\Collections\Collection;

interface ComponentExportable
{
    public function export(mixed $component) : Collection;
}