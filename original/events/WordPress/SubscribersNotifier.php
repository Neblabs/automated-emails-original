<?php

namespace AutomatedEmails\Original\Events\Wordpress;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Events\EventHandlerFactory;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\Wordpress\Abilities\CustomEvent;
use AutomatedEmails\Original\Events\Wordpress\EventHandler;
use AutomatedEmails\Original\System\Functions\GlobalFunctionWrapper;
use function AutomatedEmails\Original\Utilities\Collection\_;

class SubscribersNotifier
{
    public function __construct(
        protected GlobalFunctionWrapper $globalFunctionWrapper = new GlobalFunctionWrapper,
        protected EventsHandler $eventsHandler = new EventsHandler(new EventHandlerFactory)
    ) {}

    public function addSubscriber(Subscriber $subscriber) : void
    {
        $this->eventsHandler->addSubscriber($subscriber);
    }

    public function notify(CustomEvent $event) : void
    {
        $this->eventsHandler->handle($event);

        $this->globalFunctionWrapper->do_action(
            hook_name: $event::class,
            arg: $event
        );
    }
}