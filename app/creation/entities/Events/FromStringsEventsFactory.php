<?php

namespace AutomatedEmails\App\Creation\Entities\Events;

use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Abilities\CreatableEntitiesWithParameters;
use AutomatedEmails\App\Creation\Entities\Abilities\OverloadableEntitiesFactory;
use AutomatedEmails\App\Creation\Entities\Conditionroots\ConditionsRootFromTemplateFactory;
use AutomatedEmails\App\Domain\Events\Event;
use AutomatedEmails\App\Domain\Events\Events;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Data\Query\Parameters;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;
use function AutomatedEmails\Original\Utilities\Collection\_;

class FromStringsEventsFactory implements CreatableEntitiesWithParameters, OverloadableEntitiesFactory
{
    public function __construct(
        protected Components $eventComponents,
        protected ConditionsRootFromTemplateFactory $conditionsRootFromTemplateFactory
    ) {}

    /** @param string $data The Event identifier */
    public function canCreateEntity(mixed $data): bool
    {
        return is_string($data) && $this->eventComponents->has($data);
    } 

    /** @param array<string> $data */
    public function canCreateEntities(mixed $data): bool
    {
        // if we return false when all but one is invalid, then the valid ones wont get created
        // if we return true when all but one is invalid, then the valid ones will fail when attempting to create
        return is_array($data) || $data instanceof Collection;
    } 

    /** @param string $data The Event identifier */
    public function createEntity(mixed $data, Parameters $parameters): Entity
    {
        (object) $eventComponent = $this->eventComponents->withId($data);
        (string) $Event = $eventComponent->type();
        
        /** @var Event */
        (object) $event = new $Event;

        $event->setConditionsRootFromTemplateFactory($this->conditionsRootFromTemplateFactory);

        return $event;
    } 

    /** @param array<string> $entitesData */
    public function createEntities(mixed $entitesData, Parameters $parameters): Entities
    {   
        return new Events(
            _($entitesData)->map(fn($data) => $this->createEntity($data, $parameters))
        );
    } 
}