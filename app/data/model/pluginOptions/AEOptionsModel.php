<?php

namespace AutomatedEmails\App\Data\Model;

use AutomatedEmails\App\Data\Schema\OptionsTable;
use AutomatedEmails\Original\Data\Schema\DatabaseTable;
use ParaTest\Runners\PHPUnit\Options;
use WTEApp\Data\Model\Options\Option;

Class AEOptionsModel extends Model
{
    public function getDomainClass() : string
    {
        return Option::class;
    }

    public function getDomainsClass() : string
    {
        return Options::class;
    }

    public function getTable() : DatabaseTable
    {
        return new AEOptionsSchema;
    }
}