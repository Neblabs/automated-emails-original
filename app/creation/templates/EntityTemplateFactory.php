<?php

namespace AutomatedEmails\App\Creation\Templates;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Domain\Templates\EntitiesTemplate;
use AutomatedEmails\App\Domain\Templates\EntityTemplate;
use AutomatedEmails\App\Domain\Templates\EntityTemplates;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

abstract class EntityTemplateFactory implements CreatableEntities
{
    abstract static public function entityTemplateClass() : string;
    abstract static public function entityTemplatesClass() : string;

    public function __construct(
        protected TemplateFactory $templateFactory,
        protected CreatableEntities $entitiesFactory
    ) {}

    public function createEntity(mixed $data): EntityTemplate
    {
        (string) $entityTemplate = static::entityTemplateClass();

        return new $entityTemplate(
            $jsonTemplate = $data,
            $templateFactory = $this->templateFactory,
            $entitiesFactory = $this->entitiesFactory
        ); 
    } 

    public function createEntities(mixed $entitesData): EntityTemplates
    {
        (string) $entityTemplatesClass =  static::entityTemplatesClass();

        (object) $entitiesTemplate = new EntitiesTemplate(
            JSONTemplate: $entitesData,
            entityTemplateFactory: $this
        );

        return new $entityTemplatesClass(
            $entitiesTemplate->createTemplates()
        );
    } 
}