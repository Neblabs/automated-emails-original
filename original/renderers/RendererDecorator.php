<?php

namespace AutomatedEmails\Original\Renderers;

use AutomatedEmails\Original\Renderers\Abilities\Renderable;

Abstract Class RendererDecorator implements Renderable
{
    protected $renderer;

    public function __construct(Renderable $renderer)
    {
        $this->renderer = $renderer;
    }
}