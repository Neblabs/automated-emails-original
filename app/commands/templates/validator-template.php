<?php

return <<<TEMPLATE
<?php

namespace AutomatedEmails\App\Validators;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;

Class {$componentName} extends Validator
{
    public static function getOptions() : Collection
    {
        return new Collection([]); 
    }

    public function isValid() : bool
    {

    }
}
TEMPLATE;
