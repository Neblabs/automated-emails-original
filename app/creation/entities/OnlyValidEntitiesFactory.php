<?php

namespace AutomatedEmails\App\Creation\Entities;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Entities\Abilities\HandleableUncreatableEntities;
use AutomatedEmails\App\Creation\Entities\Abilities\OverloadableEntitiesFactory;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

use function AutomatedEmails\Original\Utilities\Collection\_;

class OnlyValidEntitiesFactory implements CreatableEntities, OverloadableEntitiesFactory
{
    public function __construct(
        protected OverloadableEntitiesFactory $validEntityValidator,
        protected CreatableEntities $entitiesFactory,
        protected ?HandleableUncreatableEntities $uncreatableEntitiesHandler = null
    ) {}
    
    public function canCreateEntities(mixed $data): bool
    {
        return is_array($data) || $data instanceof Collection;    
    } 

    public function canCreateEntity(mixed $data): bool
    {
        return $this->validEntityValidator->canCreateEntity($data);
    } 

    /** @param array|Collection $entitesData */
    public function createEntities(mixed $entitesData): Entities
    {
        (object) $validEntitiesData = _($entitesData)->filter(
            $this->validEntityValidator->canCreateEntity(...)
        );

        $this->optionallyHandleInvalidEntities(_($entitesData), $validEntitiesData);

        return $this->entitiesFactory->createEntities(
            $validEntitiesData->asArray()
        );
    } 

    public function createEntity(mixed $data): Entity
    {
        return $this->entitiesFactory->createEntity($data);
    } 

    protected function optionallyHandleInvalidEntities(Collection $allEntitiesData, Collection $validEntitiesData) : void
    {
        (boolean) $hasInvalidData = $allEntitiesData->count() !== $validEntitiesData->count();

        // if has invalid, call the handler if exists
        if ($hasInvalidData) {
            $this->uncreatableEntitiesHandler?->handle(
                $allEntitiesData->asArray(), 
                $validEntitiesData->asArray()
            );
        }
    }
}