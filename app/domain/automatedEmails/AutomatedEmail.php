<?php

namespace AutomatedEmails\App\Domain\AutomatedEmails;

use AutomatedEmails\App\Domain\ConditionRoots\ConditionRoots;
use AutomatedEmails\App\Domain\ConditionRoots\ConditionsRoot;
use AutomatedEmails\App\Domain\Conditions\Abilities\Passable;
use AutomatedEmails\App\Domain\Conditions\Condition;
use AutomatedEmails\App\Domain\Conditions\Conditions;
use AutomatedEmails\App\Domain\Conditions\PassableComposite;
use AutomatedEmails\App\Domain\Conditions\SubjectConditions;
use AutomatedEmails\App\Domain\Contents\Content;
use AutomatedEmails\App\Domain\Emails\Email;
use AutomatedEmails\App\Domain\Events\Event;
use AutomatedEmails\App\Domain\Recipients\Recipients;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Domain\Entity;

use function AutomatedEmails\Original\Utilities\Collection\_;

Class AutomatedEmail extends Entity
{
    protected Event $event;
    protected Recipients $recipients;
    protected Content $subject;
    protected Content $body;

    public function __construct(
        private int $id,
        private ConditionRoots $conditionRoots = new ConditionRoots([])
    ) {}

    public function id() : int
    {
        return $this->id;
    }

    public function event() : Event
    {
        return $this->event;
    }

    public function setEvent(Event $event) 
    {
        $this->event = $event;
        
        $this->conditionRoots->setDefaultConditionsRoot($event->defaultConditions());
    }

    public function defaultConditions() : Collection
    {
        return _($this->conditionRoots->defaultConditionsRoot())->filter();
    }

    public function customConditions() : Collection
    {
        return $this->conditionRoots->customConditionRoots();
    }

    public function setCustomConditionsRoot(ConditionsRoot $conditions) 
    {
        $this->conditionRoots->set([$conditions]);
    }

    public function recipients() : Recipients
    {
        return $this->recipients;
    }

    public function setRecipients(Recipients $recipients) 
    {
        $this->recipients = $recipients;
    }

    public function subject() : Content
    {
        return $this->subject;
    }

    public function setSubject(Content $subject) : void
    {
        $this->subject = $subject;
    }

    public function body() : Content
    {
        return $this->body;
    }
    
    public function setBody(Content $body) : void
    {
        $this->body = $body;
    }

    public function canBeSent() : bool
    {
        return $this->conditionRoots->passes() && $this->recipients->hasValid();
    }

    public function email() : Email
    {
        (object) $email = new Email;

        $email->addRecipients(
            $this->recipients->withoutDuplicates()
                             ->onlyWithValidEmails()
                             ->asStrings()
        );
        $email->setSubject($this->subject->body());
        $email->setBody($this->body->body());

        return $email;
    }
}