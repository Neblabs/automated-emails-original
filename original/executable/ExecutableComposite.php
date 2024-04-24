<?php

namespace AutomatedEmails\Original\Executable;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Executable\Abilities\Executable;

class ExecutableComposite implements Executable
{
    public function __construct(
        protected Collection/*<Executable>*/ $executables
    ) {}
    
    public function execute()
    {
        $this->executables->perform(execute: null);
    } 
}