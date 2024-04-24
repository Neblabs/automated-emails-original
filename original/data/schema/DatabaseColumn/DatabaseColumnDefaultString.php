<?php

namespace AutomatedEmails\Original\Data\Schema\DatabaseColumn;

use AutomatedEmails\Original\Data\Schema\DatabaseColumn\DatabaseColumnDefault;

Class DatabaseColumnDefaultString extends DatabaseColumnDefault
{
    public function getDefinition()
    {
        return "DEFAULT '{$this->getCleanValue()}'";
    }
}
