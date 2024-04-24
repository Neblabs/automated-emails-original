<?php

namespace AutomatedEmails\Original\Renderers\Language;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Renderer\Language\InlineStatementRenderer;
use AutomatedEmails\Original\Renderers\Abilities\Renderable;
use AutomatedEmails\Original\Renderers\Language\NewLineRenderer;

Class InlineStatementsRenderer implements Renderable
{
    public function __construct(iterable $renderers)
    {
        $this->renderers = Collection::create($renderers)->map(function(Renderable $renderable) : InlineStatementRenderer {
            return new InlineStatementRenderer($renderable);
        });
    }
    
    public function render() : string
    {
        return $this->renderers->map(function(InlineStatementRenderer $inlineStatementRenderer) : string {
            return (new NewLineRenderer($inlineStatementRenderer))->render();
        })->implode()->trim("\n");
    }
}
