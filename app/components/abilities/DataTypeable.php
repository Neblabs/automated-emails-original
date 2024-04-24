<?php

namespace AutomatedEmails\App\Components\Abilities;

use AutomatedEmails\App\Components\Data\DataTypeComponent;

interface DataTypeable
{
    public function dataType() : DataTypeComponent;
}