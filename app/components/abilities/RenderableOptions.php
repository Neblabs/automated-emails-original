<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\Original\Collections\Collection;

interface RenderableOptions
{
    public function render() : Collection; 
}