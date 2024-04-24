<?php

namespace AutomatedEmails\App\Domain\Recipients;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Domain\Entities;

use function AutomatedEmails\Original\Utilities\Text\i;

Class Recipients extends Entities
{
    protected function getDomainClass() : string
    {
        return Recipient::class;
    }

    public function canBeUsed() : bool
    {
        return false;
    }

    public function hasValid() : bool
    {
        return $this->entities->have(fn(Recipient $recipient) => $recipient->emailIsValid());
    }

    public function withoutDuplicates() : self
    {
        return new static(
            $this->entities->map(
                fn(Recipient $recipient) => i($recipient->email())->trim()->toLowerCase()
            )->withoutDuplicates()
             ->map(
                fn(string $uniqueEmail) => $this->entities->find(
                    fn(Recipient $recipient) => i($recipient->email())->is($uniqueEmail)
                )
            )
        );
    }

    public function onlyWithValidEmails() : self
    {
        return new static(
            $this->entities->filter(
                fn(Recipient $recipient) => $recipient->emailIsValid()
            )->getValues()
        );
    }

    public function asStrings() : Collection
    {
        return $this->entities->map(
            fn(Recipient $recipient) => $recipient->email()
        );
    }
}