<?php

namespace AutomatedEmails\App\Data\Model;

use AutomatedEmails\App\Data\Schema\OptionsTable;
use AutomatedEmails\Original\Data\Schema\DatabaseTable;
use ParaTest\Runners\PHPUnit\Options;
use WTEApp\Data\Model\Options\Option;

Class OptionsModel extends Model
{
    public function getAliases() : array
    {
        return [
            'name' => 'option_name',
            'value' => 'option_value'
        ];   
    }
    
    public function getDomainClass() : string
    {
        return Option::class;
    }

    public function getDomainsClass() : string
    {
        return Options::class;
    }

    public function getSchema() : DatabaseTable
    {
        return new OptionsSchema;
    }
}