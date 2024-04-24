<?php

namespace AutomatedEmails\Original\Renderers\Classes;

use AutomatedEmails\Original\Collections\TypedCollection;
use AutomatedEmails\Original\Renderers\Abilities\Renderable;
use AutomatedEmails\Original\System\Compositable;

Class Renderers implements Renderable
{
    private $renderersComposite;

    public function __construct(iterable $renderers)
    {
        $this->renderersComposite = new Compositable($renderers);
    }

    public function render()
    {
        $this->renderersComposite->render();
    }
}