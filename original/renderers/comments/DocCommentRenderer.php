<?php

namespace AutomatedEmails\Original\Renderers\Comments;

use AutomatedEmails\Original\Renderers\RendererDecorator;

Class DocCommentRenderer extends RendererDecorator
{
    public function render() : string
    {
        return 
"/**
 {$this->renderer->render()}
 */";
    }
}