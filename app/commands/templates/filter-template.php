<?php

return <<<TEMPLATE
<?php

namespace AutomatedEmails\App\Conditions\BuiltIn\Filters;

use AutomatedEmails\App\Conditions\Filter;
use AutomatedEmails\App\Conditions\ItemsSet;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;

Class {$componentName} extends Filter
{
    protected function getOptions() : Collection
    {
        return new Collection([
        ]);   
    }

    protected function shouldUseGlobalSet() : bool
    {
        return false;
    }

    protected function filterItems() : ItemsSet
    {
        (object) \$items = \$this->getSetToFilter()->getItems();
    }
}
TEMPLATE;
