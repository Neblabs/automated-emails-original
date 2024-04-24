<?php

namespace AutomatedEmails\App\Domain\Templates\Abilities;

use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Domain\Templates\EntityTemplate;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Domain\Entities;

abstract class EntitiesTemplateFactory 
{
    abstract public function createEntityTemplate(string $JSONTemplate) : EntityTemplate;
    abstract public function createEntities(Collection $entities) : Entities;

    public function __construct(
        protected TemplateFactory $templateFactory
    ) {}
}