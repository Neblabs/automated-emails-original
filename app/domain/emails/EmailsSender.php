<?php

namespace AutomatedEmails\App\Domain\Emails;

use AutomatedEmails\App\Domain\AutomatedEmails\AutomatedEmail;
use AutomatedEmails\App\Domain\AutomatedEmails\AutomatedEmails;
use AutomatedEmails\App\Domain\Emails\Abilities\EmailSendingStrategy;
use AutomatedEmails\Original\Collections\Collection;
use function AutomatedEmails\Original\Utilities\Collection\_;

class EmailsSender
{
    /**
     * todo: maybe we should only store the ids in order to save memory
     */
    public function __construct(
        protected EmailSendingStrategy $emailSendingStrategy,
        protected Collection $sentEmailIds = new Collection([])
    ) 
    {}

    public function tryToSend(AutomatedEmail $automatedEmail) : void
    {
        if ($this->isSendable($automatedEmail)) {
            $this->send($automatedEmail);
        }
    }

    public function send(AutomatedEmail $automatedEmail) : void
    {
        $this->emailSendingStrategy->send($automatedEmail->email());

        $this->addToSentEmails($automatedEmail);
    }

    public function sendEmail(Email $email) : void
    {
        $email->send();
    }

    public function hasSent(AutomatedEmail $automatedEmail) : bool
    {
        return $this->sentEmailIds->have($automatedEmail->id());
    }

    protected function isSendable(AutomatedEmail $automatedEmail) : bool
    {
        return !$this->hasSent($automatedEmail) && $automatedEmail->canBeSent();
    }

    protected function addToSentEmails(AutomatedEmail $automatedEmail) : void
    {
        $this->sentEmailIds->push($automatedEmail->id());   
    }
}