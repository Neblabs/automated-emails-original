<?php

namespace AutomatedEmails\App\Creation\Entities\Recipients;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Data\Finders\Recipients\RecipientsFinder;
use AutomatedEmails\App\Domain\AutomatedEmails\AutomatedEmail;
use AutomatedEmails\App\Domain\Recipients\Recipient;
use AutomatedEmails\App\Domain\Recipients\Recipients;
use AutomatedEmails\Original\Data\Drivers\SQL\WordPressDatabaseReadableDriver;
use AutomatedEmails\Original\Data\Query\SQLParameters;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

class RecipientsFromEmailFactory implements CreatableEntities
{
    public function __construct(
        protected WordPressDatabaseReadableDriver $readableDriver,
        protected SQLParameters $parameters,
        protected RecipientEntitiesFromEmailFactory $recipientEntitiesFromEmailFactory
    ) {}

    /** @param AutomatedEmail $entitesData */
    public function createEntities(mixed $entitesData): Recipients
    {
        (object) $recipientsFinder = new RecipientsFinder(
            readableDriver: $this->readableDriver,
            parameters: $this->parameters,
            entityFactory: $this->recipientEntitiesFromEmailFactory->create($entitesData)
        );

        return $recipientsFinder->forEmail($entitesData)->findThem();   
    } 


    //NOT TESTED YET!
    /** @param AutomatedEmail $data */
    public function createEntity(mixed $data): Recipient
    {
        return $this->recipientsFinder->forEmail($data)->findIt();        
    } 
}