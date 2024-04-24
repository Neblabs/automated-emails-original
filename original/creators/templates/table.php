<?php

return <<<TEMPLATE
<?php

namespace AutomatedEmails\App\Data\Schema;

use AutomatedEmails\Original\Data\Schema\DatabaseColumn;
use AutomatedEmails\Original\Data\Schema\DatabaseTable;
use AutomatedEmails\Original\Environment\Env;

Class {$this->getTableName()} extends DatabaseTable
{
    protected function name()
    {
        return strtolower(Env::id() . '_{$this->pluralName}');
    }

    protected function fields()
    {
        return [
            'primary' => new DatabaseColumn('id',         'integer', 'NOT NULL UNIQUE AUTO_INCREMENT'),
        ];
    }

    protected function changes()
    {
        return [
            'transforms' => [
                //[
                //    'from' => new DatabaseColumn('id',         'integer'),
                //    'to' => new DatabaseColumn('identifier',         'integer'),
                //]
            ],
            'additions' => [
            ],
            'deductions' => [
            ]
        ];
    }
}
TEMPLATE;
