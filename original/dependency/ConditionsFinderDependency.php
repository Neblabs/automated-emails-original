<?php

namespace AutomatedEmails\Original\Dependency;

use AutomatedEmails\App\Data\Finders\Conditions\ConditionsFinder;
use AutomatedEmails\App\Data\Finders\Conditions\ConditionsStructure;
use AutomatedEmails\Original\Data\Drivers\SQL\WordPressDatabaseReadableDriver;
use AutomatedEmails\Original\Data\Query\SQLParameters;

class ConditionsFinderDependency implements Dependency
{
    public function __construct(
        protected WordPressDatabaseReadableDriver $wordPressDatabaseReadableDriver,
        protected ConditionsStructure $conditionsStructure,
        protected ConditionsFactory $conditionsFactory
    ) {}

    public function canBeUsed(Context $context, Environment $environment): bool
    {
        return $environment->isProduction;
    } 

    public function create() : ConditionsFinder
    {
        return new ConditionsFinder(
            $this->wordPressDatabaseReadableDriver,
            new SQLParameters($this->conditionsStructure),
            $this->conditionsFactory
        );
    }
}