<?php

namespace AutomatedEmails\Original\Renderers\Comments;

use AutomatedEmails\Original\Renderers\Language\NewLineRenderer;
use AutomatedEmails\Original\Renderers\Language\TextRenderer;
use AutomatedEmails\Original\Renderers\RendererDecorator;

Class DocCommentLineRenderer extends RendererDecorator
{
    public function render() : string
    {
        return "* {$this->renderer->render()}";
    }
}