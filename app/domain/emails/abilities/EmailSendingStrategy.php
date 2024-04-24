<?php

namespace AutomatedEmails\App\Domain\Emails\Abilities;

use AutomatedEmails\App\Domain\Emails\Email;

interface EmailSendingStrategy
{
    public function send(Email $email); 
}