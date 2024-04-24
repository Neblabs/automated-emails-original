<?php

namespace AutomatedEmails\App\Domain\Templates;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Data\DataTemplateFactory;
use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Creation\Data\TextTemplateFactory;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\App\Domain\Data\TextTemplate;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\JSONMapper;
use AutomatedEmails\Original\Collections\MappedObject;
use AutomatedEmails\Original\Domain\Entity;

abstract class EntityTemplate extends Entity
{
    protected TextTemplate $textTemplate;

    abstract static public function definition() : Collection;

    public function __construct(
        string $jsonTemplate,
        protected TemplateFactory $templateFactory,
        protected CreatableEntities $entitiesFactory
    ) {
        $this->textTemplate = $templateFactory->createTextTemplate($jsonTemplate);
    }

    public function create(DataSetCollection $eventData): Entity
    {
        (object) $mapped = $this->map($eventData);

        return $this->entitiesFactory->createEntity($mapped->asArray());
    } 

    public function map(DataSetCollection $eventData) : MappedObject
    {
        (object) $mapper = new JSONMapper(map: static::definition()->asArray());

        return $mapper->map($this->textTemplate->render($eventData));
    }
}