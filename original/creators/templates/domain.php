<?php

return <<<TEMPLATE
<?php

namespace {$this->getModelNamespace()};

use AutomatedEmails\Original\Data\Model\Domain;

Class {$this->singularName} extends Domain
{

}
TEMPLATE;
