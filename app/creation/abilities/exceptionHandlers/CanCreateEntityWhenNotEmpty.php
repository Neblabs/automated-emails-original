<?php

namespace AutomatedEmails\App\Creation\Abilities\Exceptionhandlers;

use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\Original\Domain\Entity;
use Exception;

class CanCreateEntityWhenNotEmpty implements CanCreateEntity
{
    public function __construct(
        protected CanCreateEntity $canCreateEntity,
        protected string $exceptionMessage = "Cannot create, the data passed is empty"
    ) {}
    
    public function createEntity(mixed $data): Entity
    {
        $this->validate($data);

        return $this->canCreateEntity->createEntity($data);
    }

    public function validate($data) : void
    {
        if ($data === "" || $data === null) {
            throw new Exception(message: $this->exceptionMessage);
        }
    } 
}