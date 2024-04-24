<?php

namespace AutomatedEmails\App\Creation\Entities\Parameters;

use AutomatedEmails\Original\Data\Query\WordPressPostQueryParameters;
use AutomatedEmails\Original\Data\Schema\Structure;

class WordPressPostQueryParametersFactory
{
    public function create(Structure $structure) : WordPressPostQueryParameters
    {
        return new WordPressPostQueryParameters($structure);
    }
}