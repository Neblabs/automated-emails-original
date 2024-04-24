<?php

namespace AutomatedEmails\Original\Construction\Events;

use AutomatedEmails\Original\Construction\Abilities\SubscriberFactory;
use AutomatedEmails\Original\Dependency\DependenciesContainer;
use AutomatedEmails\Original\Events\Subscriber;

class FromDependenciesContainerSubscriberFactory implements SubscriberFactory
{
    public function __construct(
        protected DependenciesContainer $dependenciesContainer
    ) {}
    
    public function create(string $subscriberType): Subscriber
    {
        return $this->dependenciesContainer->get($subscriberType);
    } 
}