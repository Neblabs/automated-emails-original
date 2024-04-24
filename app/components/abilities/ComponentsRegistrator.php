<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\App\Components\Components;
use AutomatedEmails\Original\Characters\StringManager;

interface ComponentsRegistrator
{
    public function id() : StringManager;

    public function canRegisterUsing(MultipleComponentsProvider $multipleComponentsProvider) : bool; 
    public function registerUsing(MultipleComponentsProvider $multipleComponentsProvider) : void;     

    public function components() : Components; 
}