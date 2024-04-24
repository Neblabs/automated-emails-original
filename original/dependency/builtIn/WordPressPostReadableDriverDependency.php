<?php

namespace AutomatedEmails\Original\Dependency\BuiltIn;

use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Construction\Data\WP_QueryFactory;
use AutomatedEmails\Original\Data\Drivers\Wordpress\WordPressPostReadableDriver;

class WordPressPostReadableDriverDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    static public function type(): string
    {
        return WordPressPostReadableDriver::class;   
    } 

    public function create(): WordPressPostReadableDriver
    {
        return new WordPressPostReadableDriver(
            new WP_QueryFactory
        );
    } 
}