<?php

namespace AutomatedEmails\App\Creation\Entities\Automatedemails;

use AutomatedEmails\App\Creation\Entities\Conditionroots\ConditionsRootFromEmailFactory;
use AutomatedEmails\App\Creation\Entities\Conditions\ConditionsFromEmailFactory;
use AutomatedEmails\App\Creation\Entities\ContentFactory;
use AutomatedEmails\App\Creation\Entities\Recipients\RecipientsFromEmailFactory;
use AutomatedEmails\App\Data\Finders\Automatedemails\AutomatedEmailsStructure;
use AutomatedEmails\App\Domain\Events\Event;

class EventToAutomatedEmailsFactory
{
    public function __construct(
        protected AutomatedEmailsStructure $automatedEmailsStructure,
        protected ConditionsRootFromEmailFactory $conditionsRootFromEmailFactory,
        protected RecipientsFromEmailFactory $recipientsFromEmailFactory,
        protected ContentFactory $contentFactory
    ) {}

    public function create(Event $event) : AutomatedEmailsFactory
    {
        return new AutomatedEmailsFactory(
            automatedEmailStructure: $this->automatedEmailsStructure,
            event: $event,
            conditionsRootFromEmailFactory: $this->conditionsRootFromEmailFactory,
            recipientsFromEmailFactory: $this->recipientsFromEmailFactory,
            contentFactory: $this->contentFactory
        );
    }
}