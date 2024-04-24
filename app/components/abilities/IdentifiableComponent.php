<?php

namespace AutomatedEmails\App\Components\Abilities;

interface IdentifiableComponent
{
    public function component() : Identifiable|HasDefaultConditions; 
}