<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Data\Drivers\SQL\WordPressDatabaseReadableDriver;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\Abilities\Context;

use wpdb;

class WordPressDatabaseReadableDriverDependency implements Cached, StaticType, Dependency
{
    public function __construct(
        protected wpdb $wpdb
    ) {}
    
    static public function type(): string
    {
        return WordPressDatabaseReadableDriver::class;   
    } 

    public function canBeCreated(Context $context): bool
    {
        return true;        
    } 

    public function create(): WordPressDatabaseReadableDriver
    {
        return new WordPressDatabaseReadableDriver(
            $this->wpdb
        );
    } 
}