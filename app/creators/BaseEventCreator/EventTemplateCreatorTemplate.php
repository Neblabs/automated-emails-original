<?php

return <<<TEMPLATE
<?php

namespace {$namespace};

use {$settings->app->namespace}\App\Components\Abilities\HasConditionsTemplate;
use {$settings->app->namespace}\App\Components\Abilities\Identifiable;
use {$componentClassName->fullyQualifiedClassName};
use {$baseEventClassName->fullyQualifiedClassName};
use {$settings->app->namespace}\Original\Characters\StringManager;

class {$className} extends {$baseEventClassName->className}
{
    protected function defaultConditionsTemplate(): StringManager
    {
        return \$this->component()->template();
    } 

    /** @return Identifiable&HasConditionsTemplate */
    public function component(): Identifiable
    {
        return new {$componentClassName->className};  
    } 
}

TEMPLATE;
