<?php

namespace AutomatedEmails\Original\Construction\Events;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Abilities\SubscriberFactory;
use AutomatedEmails\Original\Events\Wordpress\Hook;
use AutomatedEmails\Original\Events\Wordpress\Hooks;
use AutomatedEmails\Original\Events\Wordpress\Request;

class HooksFactory
{
    public function __construct(
        protected HookFactory $hookFactory,
        protected SubscriberFactory $subscriberFactory
    ) {}
    
    public function createFromGroupedSubscriberTypes(Collection $groupedSubscriberTypes) : Hooks
    {
        return new Hooks(
            $groupedSubscriberTypes->map(
                function(Collection $subscribersGroup, string $hookName) {
                    (object) $hook = $this->hookFactory->createFromRequest(
                        new Request\Action(name: $hookName)
                    );

                    $hook->addSubscribers($subscribersGroup->map(
                        fn(string $subscriberType) => $this->subscriberFactory->create(
                            $subscriberType
                        )
                    ));

                    return $hook;
                }
            )
        );
    }
}