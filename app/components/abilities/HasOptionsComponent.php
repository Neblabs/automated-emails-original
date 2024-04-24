<?php

namespace AutomatedEmails\App\Components\Abilities;

interface HasOptionsComponent
{
    public function options() : HasTemplateOptions; 
}