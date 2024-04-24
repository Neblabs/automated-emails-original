<?php

namespace AutomatedEmails\App\Subscribers;

use AutomatedEmails\App\Data\Finders\Automatedemails\AutomatedEmailsFinder;
use AutomatedEmails\App\Domain\AutomatedEmails\AutomatedEmails;
use AutomatedEmails\App\Domain\Emails\EmailsSender;
use AutomatedEmails\App\Domain\Events\Event;
use AutomatedEmails\Original\Events\Parts\DefaultPriority;
use AutomatedEmails\Original\Events\Parts\WillAlwaysExecute;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\Wordpress\EventArguments;

use function AutomatedEmails\Original\Utilities\Collection\_;

/**
 * This subscriber will be executed for EVERY event.
 */
Class AutomatedEmailsLoaderSender implements Subscriber
{
    use DefaultPriority;
    use WillAlwaysExecute;

    public function __construct(
        protected AutomatedEmailsFinder $automatedEmailsFinder,
        protected EmailsSender $emailsSender 
    ) {}
    
    public function createEventArguments(Event $event) : EventArguments
    {
        return new EventArguments(_(
            automatedEmailsForThisEvent: $this->automatedEmailsFinder->for($event)->onlyThoseEnabled()->findThem()
        ));
    }

    public function execute(AutomatedEmails $automatedEmailsForThisEvent) : void
    {
        $automatedEmailsForThisEvent->sendUsing($this->emailsSender);
    }
} 

