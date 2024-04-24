<?php

namespace AutomatedEmails\App\Creation\Entities\Automatedemails;

use AutomatedEmails\App\Data\Finders\Automatedemails\AutomatedEmailsFinder;
use AutomatedEmails\App\Domain\Events\Event;
use AutomatedEmails\Original\Data\Drivers\SQL\WordPressDatabaseReadableDriver;
use AutomatedEmails\Original\Data\Query\WordPressPostQueryParameters;

class AutomatedEmailsFinderFactory
{
    public function __construct(
        protected WordPressDatabaseReadableDriver $wordPressDatabaseReadableDriver,
        protected WordPressPostQueryParameters $automatedEmailsPostQueryParameters,
        protected EventToAutomatedEmailsFactory $eventToAutomatedEmailsFactory
    ) {}

    public function create(Event $event) : AutomatedEmailsFinder
    {
        return new AutomatedEmailsFinder(
            readableDriver: $this->wordPressDatabaseReadableDriver,
            parameters: $this->automatedEmailsPostQueryParameters, 
            entityFactory: $this->eventToAutomatedEmailsFactory->create($event)
        );
    }
}