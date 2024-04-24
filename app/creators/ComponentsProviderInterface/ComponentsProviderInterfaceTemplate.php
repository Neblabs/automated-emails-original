<?php

return <<<TEMPLATE
<?php

namespace {$namespace};

use {$settings->app->namespace}\Original\Collections\Collection;

interface {$className}
{
    public function {$componentsProviderInterfaceName->withoutSuffix()->toLowercase()->ensureRight('s')}() : Collection; 
}

TEMPLATE;
