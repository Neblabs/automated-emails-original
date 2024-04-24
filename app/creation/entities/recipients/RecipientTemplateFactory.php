<?php

namespace AutomatedEmails\App\Creation\Entities\Recipients;

use AutomatedEmails\App\Creation\Templates\EntityTemplateFactory;
use AutomatedEmails\App\Domain\Recipients\Templates\RecipientTemplate;
use AutomatedEmails\App\Domain\Recipients\Templates\RecipientTemplates;

class RecipientTemplateFactory extends EntityTemplateFactory
{
    static public function entityTemplateClass() : string
    {
        return RecipientTemplate::class;
    }

    static public function entityTemplatesClass() : string
    {
        return RecipientTemplates::class;
    }
}