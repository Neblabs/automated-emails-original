<?php

namespace AutomatedEmails\App\Domain\Recipients;

use AutomatedEmails\Original\Domain\Entity;

Class Recipient extends Entity
{
    public function __construct(
        protected string $email
    ) {}

    public function email() : string
    {
        return $this->email;
    }

    public function emailIsValid() : bool
    {
        return is_email($this->email);
    }
}