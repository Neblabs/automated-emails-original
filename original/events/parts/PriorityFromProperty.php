<?php

namespace AutomatedEmails\Original\Events\Parts;

trait PriorityFromProperty
{
    public function priority() : int
    {
        return $this->priority;
    } 
}