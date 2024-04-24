<?php

namespace AutomatedEmails\Original\Dependency\BuiltIn;

use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Construction\Abilities\SubscriberFactory;
use AutomatedEmails\Original\Construction\Events\HookFactory;
use AutomatedEmails\Original\Construction\Events\HooksFactory;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Events\Wordpress\Framework\RegisteredSubscribers;
use AutomatedEmails\Original\Events\Wordpress\Hooks;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;

class HooksDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    public function __construct(
        protected RegisteredSubscribers $registeredSubscribers,
        protected SubscriberFactory $subscriberFactory,
        protected HookFactory $hookFactory
    ) {}
    
    static public function type(): string
    {
        return Hooks::class;        
    } 

    public function create(): object
    {
        (object) $hooksFactory = new HooksFactory(
            hookFactory: $this->hookFactory,
            subscriberFactory: $this->subscriberFactory
        );

        return $hooksFactory->createFromGroupedSubscriberTypes(
            $this->registeredSubscribers->get()
        );
    } 
}