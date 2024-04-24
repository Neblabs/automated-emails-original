<?php

namespace AutomatedEmails\App\Domain\AutomatedEmails;

use AutomatedEmails\App\Domain\Emails\EmailsSender;
use AutomatedEmails\App\Domain\Events\Event;
use AutomatedEmails\Original\Domain\Entities;

Class AutomatedEmails extends Entities
{
    protected function getDomainClass() : string
    {
        return AutomatedEmail::class;
    }

    public function sendUsing(EmailsSender $emailsSender) : void
    {
        $this->entities->forEvery($emailsSender->tryToSend(...));
    }
}