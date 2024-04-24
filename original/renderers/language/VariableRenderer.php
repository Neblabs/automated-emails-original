<?php

namespace AutomatedEmails\Original\Renderers\Language;

use AutomatedEmails\Original\Renderers\Abilities\Renderable;

Class VariableRenderer implements Renderable
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;   
    }
    
    public function render() : string
    {
        return "\${$this->name}";
    }
}
