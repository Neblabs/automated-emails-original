<?php

namespace AutomatedEmails\Original\Renderers\Comments;

use AutomatedEmails\Original\Renderers\Abilities\Renderable;
use AutomatedEmails\Original\Renderers\RendererDecorator;

Class AnnotationRenderer extends RendererDecorator
{
    public function render() : string
    {
        return "@{$this->renderer->render()}";
    }
}
