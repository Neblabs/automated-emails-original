<?php

namespace AutomatedEmails\App\Domain\Contents\Templates;

use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Domain\Contents\Contents;
use AutomatedEmails\App\Domain\Templates\Abilities\EntitiesTemplateFactory;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Domain\Entities;

class ContentsTemplate extends EntitiesTemplateFactory
{
    public function createEntityTemplate(string $JSONTemplate) : ContentTemplate
    {
        return new ContentTemplate($JSONTemplate, $this->templateFactory);
    }

    public function createEntities(Collection $entities) : Contents
    {
        return new Contents($entities);
    }
}