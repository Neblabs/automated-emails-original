<?php

namespace AutomatedEmails\App\Creation\Entities;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Entities\Abilities\OverloadableEntitiesFactory;
use AutomatedEmails\App\Domain\Recipients\Recipient;
use AutomatedEmails\App\Domain\Recipients\Recipients;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Domain\Entities;
use function AutomatedEmails\Original\Utilities\Collection\_;

//TODO: WE NEED TO TEST THIS!

class RecipientsFactory implements CreatableEntities, OverloadableEntitiesFactory
{
    public function canCreateEntity(mixed $data): bool
    {
        return is_array($data) || $data instanceof Collection;
    } 

    public function canCreateEntities(mixed $data): bool
    {
        return $this->canCreateEntity($data) && true;// $isACollectionOfArraysOrCollections;
    } 

    public function createEntity(mixed $data): Recipient
    {
        return new Recipient(email: _($data)->get('email'));
    } 

    public function createEntities(mixed $entitesData): Recipients
    {
        return new Recipients(
            _($entitesData)->map($this->createEntity(...))
        );
    } 
}