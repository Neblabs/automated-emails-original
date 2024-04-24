<?php

namespace AutomatedEmails\Original\Renderers\Language;

use AutomatedEmails\Original\Renderers\RendererDecorator;

Class TabRenderer extends RendererDecorator
{
    public function render() : string
    {
        return "    {$this->renderer->render()}";
    }
}