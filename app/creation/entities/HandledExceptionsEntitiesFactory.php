<?php

namespace AutomatedEmails\App\Creation\Entities;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Abilities\HandlesCreatableEntitiesExceptions;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;
use Throwable;

class HandledExceptionsEntitiesFactory implements CreatableEntities 
{
    public function __construct(
        protected CreatableEntities $entitesFactory,
        protected HandlesCreatableEntitiesExceptions $creatableEntitiesExceptionHandler,
    ) {}
    
    public function createEntity(mixed $data): Entity
    {
        try {
            return $this->entitesFactory->createEntity($data);
        } catch (Throwable $exception) {
            /*Entities|null*/$handlerResult = $this->creatableEntitiesExceptionHandler->handleCreateEntityException(
                $exception, 
                $data
            );
            
            return $handlerResult ?? throw $exception;
        }
    } 

    public function createEntities(mixed $entitesData): Entities
    {
        try {
            return $this->entitesFactory->createEntities($entitesData);
        } catch (Throwable $exception) {
            /*Entities|null*/$handlerResult = $this->creatableEntitiesExceptionHandler->handleCreateEntitiesException(
                $exception, 
                $entitesData
            );

            return $handlerResult ?? throw $exception;
        }
    } 
}