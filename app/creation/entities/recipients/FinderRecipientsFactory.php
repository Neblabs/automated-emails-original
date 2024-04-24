<?php

namespace AutomatedEmails\App\Creation\Entities\Recipients;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Entities\Abilities\OverloadableEntitiesFactory;
use AutomatedEmails\App\Domain\Recipients\Recipient;
use AutomatedEmails\App\Domain\Recipients\Recipients;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

class FinderRecipientsFactory implements CreatableEntities, OverloadableEntitiesFactory 
{
    public function __construct(
        protected RecipientsFinder $recipientsFinder,
        protected AutomatedEmail $automatedEmail
    ) {}

    public function canCreateEntity(mixed $data): bool
    {
        return false;
    } 

    public function canCreateEntities(mixed $data): bool
    {
        return $data === null;
    } 

    public function createEntities(mixed $entitesData): Recipients
    {
        return $this->recipientsFinder->belongingToEmail($this->automatedEmail)->findThem();
    } 

    public function createEntity(mixed $data): Recipient
    {
        // can't create a singlular Recipient from the database at the moment.
    } 
}