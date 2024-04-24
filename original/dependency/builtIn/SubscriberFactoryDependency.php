<?php

namespace AutomatedEmails\Original\Dependency\BuiltIn;


use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Construction\Abilities\SubscriberFactory;
use AutomatedEmails\Original\Construction\Events\FromDependenciesContainerSubscriberFactory;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\DependenciesContainer;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\Abilities\Context;

class SubscriberFactoryDependency implements Cached, StaticType, Dependency
{
    public function __construct(
        protected DependenciesContainer $dependenciesContainer
    ) {}
    
    static public function type(): string
    {
        return SubscriberFactory::class;        
    } 

    public function canBeCreated(Context $context): bool
    {
        return true;        
    } 

    public function create(): FromDependenciesContainerSubscriberFactory    
    {
        return new FromDependenciesContainerSubscriberFactory(
            $this->dependenciesContainer
        );
    } 
}