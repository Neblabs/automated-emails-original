<?php

return <<<TEMPLATE
<?php

namespace {$namespace};

use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;

use function AutomatedEmails\Original\Utilities\Collection\_;

class {$className} implements TemplateDefinition
{
    public function definition(): Collection
    {
        return _(
            //statuses: Types::COLLECTION,            
        );
    }
}

TEMPLATE;
