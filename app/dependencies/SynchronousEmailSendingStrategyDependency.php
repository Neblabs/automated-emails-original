<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Domain\Emails\Abilities\EmailSendingStrategy;
use AutomatedEmails\App\Domain\Emails\SynchronousEmailSendingStrategy;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;

class SynchronousEmailSendingStrategyDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    static public function type(): string
    {
        return EmailSendingStrategy::class;   
    } 

    public function create(): EmailSendingStrategy
    {
        return new SynchronousEmailSendingStrategy;
    } 
}