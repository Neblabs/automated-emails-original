<?php

namespace AutomatedEmails\Original\Dependency\BuiltIn;

use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Dependency\Abilities\Context;
use AutomatedEmails\Original\System\ObjectWrapper;

class ObjectWrapperDependency implements Cached, StaticType, Dependency
{
    static public function type(): string
    {
        return ObjectWrapper::class;   
    } 

    public function canBeCreated(Context $context): bool
    {
        return $context->nameIs('wordpressDatabaseWrapper');
    } 

    public function create(): ObjectWrapper
    {
        global $wpdb;

        return new ObjectWrapper($wpdb);
    } 
}