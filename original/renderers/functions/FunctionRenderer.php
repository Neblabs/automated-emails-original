<?php

namespace AutomatedEmails\Original\Renderers\Functions;

use AutomatedEmails\Original\Renderers\Abilities\Renderable;
use AutomatedEmails\Original\Renderers\Functions\FunctionArgumentsRenderer;
use AutomatedEmails\Original\Renderers\Functions\FunctionReturnTypeRenderer;
use AutomatedEmails\Original\System\Compositable;

Class FunctionRenderer implements Renderable
{
    private $name;
    private $functionArgumentsRenderer;
    private $functionReturnTypeRenderer;
    private $functionBodyRenderer;

    public function __construct()
    {
        $this->name = '';
        $this->functionArgumentsRenderer = new Compositable([]);
        $this->functionReturnTypeRenderer = new Compositable([]);
        $this->functionBodyRenderer = new Compositable([]);
    }

    public function setName(string $name)
    {
        $this->name = $name;   
    }
    
    public function setReturnTypeRenderer(FunctionReturnTypeRenderer $functionReturnTypeRenderer)
    {
        $this->functionReturnTypeRenderer = $functionReturnTypeRenderer;
    }

    public function setArgumentsRenderer(FunctionArgumentsRenderer $functionArgumentsRenderer)
    {
        $this->functionArgumentsRenderer = $functionArgumentsRenderer;
    }

    public function setBodyRenderer(Renderable $functionBodyRenderer)
    {
        $this->functionBodyRenderer = $functionBodyRenderer;
    }
    
    public function render() : string
    {
        return 
    "function{$this->renderName()}({$this->functionArgumentsRenderer->render()}) {$this->functionReturnTypeRenderer->render()}
    {
        {$this->functionBodyRenderer->render()}
    }";
    }

    protected function renderName() : string
    {
        if ($this->name) {
            return " {$this->name}";   
        }
        // notice the space at the beginning
        return '';
    }
    
}