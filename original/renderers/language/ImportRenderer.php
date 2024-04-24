<?php

namespace AutomatedEmails\Original\Renderers\Language;

use AutomatedEmails\Original\Renderers\Abilities\Renderable;

Class ImportRenderer implements Renderable
{
    private $fullyQualifiedClassName;

    public function __construct(string $fullyQualifiedClassName)
    {
        $this->fullyQualifiedClassName = $fullyQualifiedClassName;
    }
    
    public function render() : string
    {
        return "use {$this->fullyQualifiedClassName}";
    }
}
