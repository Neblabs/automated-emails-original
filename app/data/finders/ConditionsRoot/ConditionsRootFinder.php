<?php

namespace AutomatedEmails\App\Data\Finders\ConditionsRoot;

use AutomatedEmails\App\Domain\AutomatedEmails\AutomatedEmail;
use AutomatedEmails\Original\Data\Model\Finder;
use AutomatedEmails\Original\Data\Query\SQLParameters;

/** @property SQLParameters $parameters */
class ConditionsRootFinder extends Finder
{
    public function forEmail(AutomatedEmail $email) : self
    {
        $this->parameters->query()->where()->equals(
            column: $this->parameters->structure()->fields()->field('postId')->name()->get(),
            value: $email->id()
        );

        return $this;
    }
}