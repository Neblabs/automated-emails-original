<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Components\AppComponents;
use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Components\Conditions\ConditionComponentsRegistrator;
use AutomatedEmails\App\Components\Data\DataComponentsRegistrator;
use AutomatedEmails\App\Components\Data\DataTypeComponentsRegistrator;
use AutomatedEmails\App\Components\Events\EventComponentsRegistrator;
use AutomatedEmails\App\Components\Passable\PassableComponentsRegistrator;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;

use function AutomatedEmails\Original\Utilities\Collection\_;

class AppComponentsDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    static public function type(): string
    {
        return AppComponents::class;   
    } 

    public function create(): AppComponents
    {
        return new AppComponents(_(
            new EventComponentsRegistrator(new Components),
            new ConditionComponentsRegistrator(new Components),
            new DataTypeComponentsRegistrator(new Components),
            new DataComponentsRegistrator(new Components),
            new PassableComponentsRegistrator(new Components)
        ));       
    } 
}