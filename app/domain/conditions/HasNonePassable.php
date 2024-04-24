<?php

namespace AutomatedEmails\App\Domain\Conditions;

/**
 * To prevent from having false positives, anything that requires a PassableComposite
 * must explicitly use this type when wanting to have an optional Passable Composite 
 * to separate the error from intent. 
 * 
 */
class HasNonePassable extends PassableComposite
{
    public function passes(): bool
    {
        return $this->passable->haveNone();
    } 
}