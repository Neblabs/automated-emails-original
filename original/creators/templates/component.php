<?php

return <<<TEMPLATE
<?php

namespace AutomatedEmails\App\Components{$extraNamespaces};

use AutomatedEmails\Original\Presentation\Component;

Class {$typeName} extends Component
{
    protected \$file = '{$nonCapitalizedTypeName}.php';
}
TEMPLATE;
