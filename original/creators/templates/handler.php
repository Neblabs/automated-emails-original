<?php

return <<<TEMPLATE
<?php

namespace AutomatedEmails\App\Handlers;

use AutomatedEmails\Original\Events\Handler\EventHandler;

Class {$typeName} extends EventHandler
{
    protected \$numberOfArguments = 1;
    protected \$priority = 10;

    public function execute()
    {
        
    }
}
TEMPLATE;
