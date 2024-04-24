<?php

namespace AutomatedEmails\App\Domain\Recipients\Templates;

use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Domain\Recipients\Templates\RecipientTemplate;
use AutomatedEmails\App\Domain\Templates\EntitiesTemplate;
use AutomatedEmails\App\Domain\Templates\EntityTemplates;
use AutomatedEmails\Original\Collections\Collection;
use Brain\Monkey\Exception;
use function AutomatedEmails\Original\Utilities\Collection\_;

class RecipientsTemplate extends EntitiesTemplate
{
    public function entityTemplateClass() : string
    {
        return RecipientTemplate::class;
    }
}