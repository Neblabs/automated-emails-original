<?php

namespace AutomatedEmails\Original\Renderers;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Renderers\Abilities\Renderable;
use AutomatedEmails\Original\Renderers\RendererDecorator;

Class RendererComposite implements Renderable
{
    private $renderers;

    public function __construct(iterable $renderers)
    {
        $this->renderers = new Collection($renderers);   
    }
    
    public function render() : string
    {
        return $this->renderers->reduce(function(string $rendered, /*Renderable|iterable*/ $renderable) {
            if (is_iterable($renderable)) {
                (string) $result = (new static($renderable))->render();
            } else {
                (string) $result = $renderable->render();
            }
            
            return "{$rendered}{$result}";
        });
    }

}