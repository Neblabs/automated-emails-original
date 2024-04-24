<?php

namespace AutomatedEmails\App\Creation\Entities\Events;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Entities\Abilities\OverloadableEntitiesFactory;
use AutomatedEmails\App\Domain\Events\Event;
use AutomatedEmails\Original\Data\Query\WordPressPostQueryParameters;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

class FromWordPressSQLParametersEventFactory implements CreatableEntities, OverloadableEntitiesFactory
{
    public function canCreateEntity(mixed $data): bool
    {
        return $data instanceof WordPressPostQueryParameters &&
               $data->metaValue() instanceof Event;
    } 

    /** @param WordPressPostQueryParameters $data */
    public function createEntity(mixed $data): Event
    {
        return $data->metaValue();
    } 

    // not implemented yet, should probably go to its own class, 
    // but ill have to refactor the whole OverloadableEntitiesFactory
    public function canCreateEntities(mixed $data): bool
    {
        
    } 

    public function createEntities(mixed $entitesData): Entities
    {
        
    } 
}