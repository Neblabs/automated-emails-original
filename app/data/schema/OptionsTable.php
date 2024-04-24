<?php

namespace AutomatedEmails\App\Data\Schema;

use AutomatedEmails\Original\Data\Schema\DatabaseColumn;
use AutomatedEmails\Original\Data\Schema\DatabaseTable;
use AutomatedEmails\Original\Environment\Env;

Class OptionsSchema extends Schema
{
    protected function identifier() : string
    {
        return 'wp_options';   
    }
    
    protected function fields() : Fields
    {
        return new Fields([
            'option_id' => Types::INTEGER()->primary()->sql('NOT NULL UNIQUE AUTO_INCREMENT'),
            'option_name' => Types::INTEGER()->sql('NOT NULL UNIQUE AUTO_INCREMENT'),
        ]);
    }
}