<?php

namespace AutomatedEmails\App\Data\Finders\Events;

use AutomatedEmails\Original\Data\Model\Finder;
use AutomatedEmails\Original\Data\Query\SQLParameters;

class EventsFinder extends Finder   
{
    #protected SQLParameters $parameters;

    public function onePerType() : self
    {
        $this->parameters->query()->groupBy(
            /*columns:*/ [$this->parameters->structure()->fields()->field('value')->name()->get()]
        );

        return $this;
    }
}