<?php

namespace AutomatedEmails\Original\Renderers\Functions;

use AutomatedEmails\Original\Renderers\Abilities\Renderable;

Class FunctionReturnTypeRenderer implements Renderable
{
    private $type;

    public function setType(string $type)
    {
        $this->type = $type;
    }
    
    public function render() : string
    {
        if ($this->type) {
            return ": {$this->type}";
        }

        return '';
    }
}
