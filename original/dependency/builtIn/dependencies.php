<?php

use AutomatedEmails\Original\Dependency\BuiltIn\HooksDependency;
use AutomatedEmails\Original\Dependency\BuiltIn\RegisteredSubscribersDependency;
use AutomatedEmails\Original\Dependency\BuiltIn\HookFactoryDependency;
use AutomatedEmails\Original\Dependency\BuiltIn\SubscriberFactoryDependency;
use AutomatedEmails\Original\Dependency\BuiltIn\ErrorHandlerDependency;
use AutomatedEmails\Original\Dependency\BuiltIn\WordPressPostReadableDriverDependency;
use AutomatedEmails\Original\Dependency\BuiltIn\ObjectWrapperDependency;

return [
    //The original deps,
    HooksDependency::class,
    RegisteredSubscribersDependency::class,
    HookFactoryDependency::class,
    SubscriberFactoryDependency::class,
    ErrorHandlerDependency::class,
    WordPressPostReadableDriverDependency::class,
    ObjectWrapperDependency::class,
];