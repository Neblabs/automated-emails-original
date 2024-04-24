<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Construction\Data\WP_QueryFactory;
use AutomatedEmails\Original\Data\Drivers\Wordpress\WordPressPostArrayReadableDriver;
use AutomatedEmails\Original\Data\Drivers\Wordpress\WordPressPostReadableDriver;
use AutomatedEmails\Original\Dependency\Abilities\Context;

class WordPressPostArrayReadableDriverDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    static public function type(): string
    {
        return WordPressPostArrayReadableDriver::class;   
    } 

    public function create(): WordPressPostArrayReadableDriver
    {
        return new WordPressPostArrayReadableDriver(
            new WordPressPostReadableDriver(
                new WP_QueryFactory
            )
        );
    } 
}