<?php

namespace WTEApp\Data\Model\Options;

use AutomatedEmails\Original\Data\Model\Domain;

Class Option extends Domain
{
    protected function fields() : array
    {
        return new Collection([
            'name' => Types::STRING,
            'value' => Types::MIXED,
        ]);
    }
}

new Option([
    'name' => 'myopt'
], new OptionsModel);