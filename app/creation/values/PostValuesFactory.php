<?php

namespace AutomatedEmails\App\Creation\Values;

use AutomatedEmails\App\Creation\DataValuesFactory;
use AutomatedEmails\App\Domain\Data\Post\PostValue;
use AutomatedEmails\App\Domain\Data\Post\PostValues;

class PostValuesFactory extends DataValuesFactory
{
    protected function dataValuesClassName() : string
    {
        return PostValues::class;
    }
}