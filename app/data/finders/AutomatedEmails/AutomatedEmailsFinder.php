<?php

namespace AutomatedEmails\App\Data\Finders\Automatedemails;

use AutomatedEmails\App\Domain\Events\Event;
use AutomatedEmails\Original\Data\Model\Finder;
use AutomatedEmails\Original\Data\Query\WordPressPostQueryParameters;
use Stringable;

/**
 * @property WordPressPostQueryParameters $parameters
 */
class AutomatedEmailsFinder extends Finder
{
    public function for(Event $event) : self
    {
        // it will be automatically converted to the event id in __toString()
        // we need the event object so that we can use it inside the factories
        $this->parameters->setMetaValue($event);

        return $this;
    }

    public function onlyThoseEnabled() : self
    {
        $this->parameters->setPostStatus('publish');

        return $this;
    }
}