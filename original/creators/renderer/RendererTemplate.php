<?php

return <<<TEMPLATE
<?php

namespace {$namespace};

use AutomatedEmails\Original\Renderers\Abilities\Renderable;

Class {$className} implements Renderable
{
    public function __construct()
    {

    }
    
    public function render() : string
    {
        return '';
    }
}

TEMPLATE;
