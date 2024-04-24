<?php

namespace AutomatedEmails\Original\Dependency\Builtin;

use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Events\Wordpress\Framework\AppSubscribers;
use AutomatedEmails\Original\Events\Wordpress\Framework\FileSubscribersGetter;
use AutomatedEmails\Original\Events\Wordpress\Framework\OriginalSubscribers;
use AutomatedEmails\Original\Events\Wordpress\Framework\RegisteredSubscribers;
use AutomatedEmails\Original\Dependency\Abilities\Context;

class RegisteredSubscribersDependency implements Cached, StaticType, Dependency
{
    static public function type(): string
    {
        return RegisteredSubscribers::class;   
    } 

    public function canBeCreated(Context $context): bool
    {
        return true;        
    } 

    public function create(): object
    {
        return new RegisteredSubscribers(
            originalSubscribersGetter: new FileSubscribersGetter(
                new OriginalSubscribers
            ),
            appSubscribersGetter: new FileSubscribersGetter(
                new AppSubscribers
            )
        );       
    } 
}