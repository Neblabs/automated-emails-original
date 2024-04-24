<?php

namespace AutomatedEmails\App\Domain\Emails;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\System\Functions\GlobalFunctionWrapper;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\i;

class Email
{
    public Collection $recipients;
    public StringManager $subject;
    public StringManager $body;

    public function __construct(
        protected GlobalFunctionWrapper $globalFunctionWrapper = new GlobalFunctionWrapper
    ) {
        $this->recipients = _([]);
    }

    public function send() : void
    {
        $this->globalFunctionWrapper->wp_mail(
            to: $this->recipients->asArray(),
            subject: $this->subject->get(),
            message: $this->body->get(),
        );
    }

    public function addRecipient(string|StringManager $recipient) : void
    {
        if ($this->recipients->doesNotHave($recipient)) {
            $this->recipients->push((string) $recipient);
        }
    }

    /** @param array<string>|Collection<string> $recipients */
    public function addRecipients(array|Collection $recipients) : void
    {
        _($recipients)->forEvery($this->addRecipient(...));
    }

    public function setSubject(string|StringManager $subject) : void
    {
        $this->subject = i($subject);
    }

    public function setBody(string|StringManager $body) : void
    {
        $this->body = i($body);
    }
}