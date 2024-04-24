<?php

namespace AutomatedEmails\App\Creation\Entities\Recipients;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Entities\RecipientsFactory;
use AutomatedEmails\App\Domain\Recipients\Recipient;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

use function AutomatedEmails\Original\Utilities\Collection\a;

class EmptyRecipientsFactory implements CreatableEntities
{
    public function __construct(
        protected RecipientsFactory $recipientsFactory
    ) {}

    public function createEntity(mixed $data): Recipient
    {
        return $this->recipientsFactory->createEntity(data: a(email: ''));    
    } 

    public function createEntities(mixed $entitesData): Entities
    {
        return $this->recipientsFactory->createEntities([]);
    } 
}