<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Creation\Entities\Automatedemails\AutomatedEmailsFinderFactory;
use AutomatedEmails\App\Creation\Entities\Automatedemails\EventToAutomatedEmailsFactory;
use AutomatedEmails\App\Data\Finders\Automatedemails\AutomatedEmailsStructure;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Data\Drivers\SQL\WordPressDatabaseReadableDriver;
use AutomatedEmails\Original\Data\Query\WordPressPostQueryParameters;

class AutomatedEmailsFinderFactoryDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    public function __construct(
        protected WordPressPostQueryParameters $automatedEmailsPostQueryParameters,
        protected WordPressDatabaseReadableDriver $wordPressDatabaseReadableDriver,
        protected EventToAutomatedEmailsFactory $eventToAutomatedEmailsFactory
    ) {}
    
    static public function type(): string
    {
        return AutomatedEmailsFinderFactory::class;       
    } 

    public function create(): object
    {
        return new AutomatedEmailsFinderFactory(
            automatedEmailsPostQueryParameters: $this->automatedEmailsPostQueryParameters,
            wordPressDatabaseReadableDriver: $this->wordPressDatabaseReadableDriver,
            eventToAutomatedEmailsFactory: $this->eventToAutomatedEmailsFactory
        );
    } 
}