<?php

namespace AutomatedEmails\App\Domain\Emails;

use AutomatedEmails\App\Domain\Emails\Abilities\EmailSendingStrategy;

class SynchronousEmailSendingStrategy implements EmailSendingStrategy
{
    public function send(Email $email)
    {
        $email->send();
    } 
}