<?php

return <<<TEMPLATE
<?php

namespace AutomatedEmails\App\Conditions\BuiltIn\Conditions;

use AutomatedEmails\App\Conditions\Condition;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;

Class {$componentName} extends Condition
{
    protected function getOptions() : Collection
    {
        return new Collection([
        ]);
    }
    
    protected function test() : bool
    {
    }
}
TEMPLATE;
