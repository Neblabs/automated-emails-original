<?php

namespace AutomatedEmails\Original\Environment\Abilities;

interface Environment
{
    public function isProduction() : bool;
    public function isDevelopment() : bool;
    public function isTesting() : bool; 
}