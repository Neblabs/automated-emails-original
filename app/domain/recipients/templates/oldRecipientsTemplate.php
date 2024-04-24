<?php

namespace AutomatedEmails\App\Domain\Recipients\Templates;

use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Domain\Recipients\Recipients;
use AutomatedEmails\App\Domain\Templates\Abilities\EntitiesTemplateFactory;
use AutomatedEmails\App\Domain\Templates\EntityTemplate;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Domain\Entities;

class _RecipientsTemplate extends EntitiesTemplateFactory
{
    public function createEntityTemplate(string $JSONTemplate) : RecipientTemplate
    {
        return new RecipientTemplate($JSONTemplate, $this->templateFactory);
    }

    public function createEntities(Collection $entities) : Recipients
    {
        return new Recipients($entities);
    }
}