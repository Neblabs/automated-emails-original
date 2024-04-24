<?php

namespace WTEApp\Data\Model\Options;

use AutomatedEmails\Original\Data\Model\Domain;

Class AEOption extends Entity
{
    protected function model() : Model
    {
        return new AEOptionsModel;   
    }
}

new Option([
    'name' => 'myopt'
], new OptionsModel);