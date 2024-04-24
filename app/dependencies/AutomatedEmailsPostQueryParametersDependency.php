<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Data\Finders\Automatedemails\AutomatedEmailsStructure;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Data\Query\WordPressPostQueryParameters;
use AutomatedEmails\Original\Dependency\Abilities\Context;

class AutomatedEmailsPostQueryParametersDependency implements Cached, StaticType, Dependency
{
    public function __construct(
        protected AutomatedEmailsStructure $automatedEmailsStructure
    ) {}
    
    static public function type(): string
    {
        return WordPressPostQueryParameters::class;   
    } 

    public function canBeCreated(Context $context): bool
    {
        return $context->nameIs('automatedEmailsPostQueryParameters');    
    } 

    public function create(): object
    {
        return new WordPressPostQueryParameters($this->automatedEmailsStructure);
    } 
}