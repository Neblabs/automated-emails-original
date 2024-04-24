<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Creation\Entities\Automatedemails\EventToAutomatedEmailsFactory;
use AutomatedEmails\App\Creation\Entities\ContentFactory;
use AutomatedEmails\App\Data\Finders\Automatedemails\AutomatedEmailsStructure;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;

class EventToAutomatedEmailsFactoryDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    public function __construct(
        protected AutomatedEmailsStructure $automatedEmailsStructure        
    ) {}
    
    static public function type(): string
    {
        return EventToAutomatedEmailsFactory::class;   
    } 

    public function create(): EventToAutomatedEmailsFactory
    {
        return new EventToAutomatedEmailsFactory(
            automatedEmailsStructure: $this->automatedEmailsStructure,
            conditionsRootFromEmailFactory: $this->conditionsRootFromEmailFactory,
            recipientsFromEmailFactory: $this->recipientsFromEmailFactory,
            contentFactory: new ContentFactory
        );       
    } 
}