<?php

namespace AutomatedEmails\App\Creation\Entities;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Domain\Contents\Content;
use AutomatedEmails\App\Domain\Contents\Contents;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

class ContentFactory implements CreatableEntities
{
    /** @param string|StringManager $data */
    public function createEntity(mixed $data): Content
    {
        return new Content($data);
    } 

    //not tested yet!
    public function createEntities(mixed $entitesData): Contents
    {
        return new Contents(_($entitesData)->map($this->createEntity(...)));    
    } 
}