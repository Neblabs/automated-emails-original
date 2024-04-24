<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\Abilities\Context;

use wpdb;

class WPDBDependency implements Cached, StaticType, Dependency
{
    static public function type(): string
    {
        return wpdb::class;   
    } 

    public function canBeCreated(Context $context): bool
    {
        return true;        
    } 

    public function create(): wpdb
    {
        global $wpdb;

        return $wpdb;   
    } 
}