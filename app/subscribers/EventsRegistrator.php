<?php

namespace AutomatedEmails\App\Subscribers;

use AutomatedEmails\App\Components\AppComponents;
use AutomatedEmails\App\Data\Finders\Events\EventsFinder;
use AutomatedEmails\App\Domain\Events\Events;
use AutomatedEmails\App\Subscribers\AutomatedEmailsLoaderSender;
use AutomatedEmails\Original\Events\Parts\DefaultPriority;
use AutomatedEmails\Original\Events\Parts\EmptyCustomArguments;
use AutomatedEmails\Original\Events\Parts\WillAlwaysExecute;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\Wordpress\EventArguments;

use function AutomatedEmails\Original\Utilities\Collection\_;

Class EventsRegistrator implements Subscriber
{
    use DefaultPriority;
    use WillAlwaysExecute;

    public function __construct(
        protected EventsFinder $eventsFinder,
        protected AutomatedEmailsLoaderSender $automatedEmailsLoaderSender,
    ) {}

    public function createEventArguments() : EventArguments
    {
        return new EventArguments(_(
            events: $this->eventsFinder->onePerType()->findThem()
        ));
    }

    public function execute(Events $events) : void
    {
        $events->registerWith(subscriber: $this->automatedEmailsLoaderSender);
    }
} 

