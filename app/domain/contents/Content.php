<?php

namespace AutomatedEmails\App\Domain\Contents;

use AutomatedEmails\Original\Domain\Entity;

Class Content extends Entity
{
    public function __construct(
        protected string $body
    ) {}
    
    public function body() : string
    {
        return $this->body;
    }
}