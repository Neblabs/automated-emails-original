<?php

namespace AutomatedEmails\Original\Data\Instructions;

use AutomatedEmails\Original\Collections\Collection;
use function AutomatedEmails\Original\Utilities\Collection\_;

class Parameters
{
    protected Collection $parameters;

    public function __construct(
    )
    {
        $this->parameters = _();
    }

    public function addParameter(Parameter $parameter) : void
    {
        $this->parameters->add($parameter);
    }
}