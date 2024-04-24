<?php

namespace AutomatedEmails\App\Domain\Recipients\Templates;

use AutomatedEmails\App\Domain\Recipients\Recipients;
use AutomatedEmails\App\Domain\Templates\EntityTemplates;

class RecipientTemplates extends EntityTemplates
{
    static protected function entitiesClass(): string
    {
        return Recipients::class;
    } 
}