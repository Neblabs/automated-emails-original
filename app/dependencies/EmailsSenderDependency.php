<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Domain\Emails\EmailsSender;
use AutomatedEmails\App\Domain\Emails\SynchronousEmailSendingStrategy;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;

class EmailsSenderDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    static public function type(): string
    {
        return EmailsSender::class;   
    } 

    public function create(): EmailsSender
    {
        return new EmailsSender(
            new SynchronousEmailSendingStrategy
        );
    } 
}