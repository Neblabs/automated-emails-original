<?php

namespace AutomatedEmails\Original\Data\Instructions;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;

Abstract Class Instruction
{
    abstract public function shouldGet() : bool;

    protected /*StringManager*/ $statement;
    protected /*Collection*/    $parameters;

    public function getStatement() : StringManager
    {
        return $this->statement;
    }

    public function getParameters() : Collection
    {
        return $this->parameters;
    }
}