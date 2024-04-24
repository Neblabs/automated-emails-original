<?php

namespace AutomatedEmails\Original\Data\Model;

use AutomatedEmails\Original\Data\Schema\DatabaseTable;

Abstract Class Model
{
    abstract public function getDomainClass() : string;
    abstract public function getDomainsClass() : string;
    abstract public function getSchema() : Schema;
}