<?php

namespace AutomatedEmails\Original\Renderer\Language;

use AutomatedEmails\Original\Renderers\RendererDecorator;

Class InlineStatementRenderer extends RendererDecorator
{
    public function render() : string
    {
        return "{$this->renderer->render()};";
    }
}