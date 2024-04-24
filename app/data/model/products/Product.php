<?php

namespace AutomatedEmails\App\Data\Model\Products;

use AutomatedEmails\Original\Data\Model\Domain;

Class AutomatedEmail extends Entity
{
    protected function fields() : array
    {
        return new Collection([
            'id' => Types::INTEGER,
            'event' => Event::class,
            'conditions' => Conditions::class,
            'recipients' => Recipients::class,
            'template' => Template::class 
        ]);
    }

    public function registerEvent()
    {
        $this->event->register();
    }

    public function send()
    {
        if ($this->conditions->pass($this->recipients->checkConditionsBeforesending())) {
            $this->recipients->send();
        }
    }
}