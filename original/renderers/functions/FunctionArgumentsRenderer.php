<?php

namespace AutomatedEmails\Original\Renderers\Functions;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Renderers\Abilities\Renderable;

Class FunctionArgumentsRenderer implements Renderable
{
    private $argumentRenderersCollection;

    public function __construct(iterable $argumentRenderers)
    {
        $this->argumentRenderersCollection = new Collection($argumentRenderers);
    }
    
    public function render() : string
    {
        return $this->argumentRenderersCollection->map(function(Renderable $renderable) : string {
            return $renderable->render();
        })->asList();
    }
}
