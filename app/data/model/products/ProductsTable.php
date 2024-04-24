<?php

namespace AutomatedEmails\App\Data\Model;

use AutomatedEmails\Original\Data\Schema\DatabaseColumn;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Data\Schema\DatabaseTable;

Class ProductsSchema extends Schema
{
    protected function name()
    {
        return new CompoundName([
            'outer' => 'wp_posts',
            'inner' => 'product'
        ]);
    }

    protected function fields()
    {
        return [
            'primary' => new DatabaseColumn('id',  'integer', 'NOT NULL UNIQUE AUTO_INCREMENT'),
        ];
    }
}