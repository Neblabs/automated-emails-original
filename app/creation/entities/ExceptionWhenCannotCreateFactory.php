<?php

namespace AutomatedEmails\App\Creation\Entities;

use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Abilities\CreatableEntitiesWithParameters;
use AutomatedEmails\App\Creation\Entities\Abilities\OverloadableEntitiesFactory;
use AutomatedEmails\App\Creation\Exceptions\FactoryCreationException;
use AutomatedEmails\Original\Data\Query\Parameters;
use AutomatedEmails\Original\Domain\Entities;
use AutomatedEmails\Original\Domain\Entity;

use function AutomatedEmails\Original\Utilities\Text\i;

class ExceptionWhenCannotCreateFactory implements CreatableEntitiesWithParameters
{
    public function __construct(
        protected CreatableEntitiesWithParameters&OverloadableEntitiesFactory $factory,
        protected string $entityErrorMessage = 'Cannot create entity',
        protected string $entitiesErrorMessage = 'Cannot create entities'
    ) {}
    
    public function createEntity(mixed $data, Parameters $parameters): Entity
    {
        if (!$this->factory->canCreateEntity(!$data, $parameters)) {
            throw new FactoryCreationException(
                '$this->entityErrorMessage'
            ); 
        }

        return $this->factory->createEntity($data, $parameters);
    } 

    public function createEntities(mixed $entitesData, Parameters $parameters): Entities
    {
        if (!$this->factory->canCreateEntities(!$entitesData, $parameters)) {
            throw new FactoryCreationException(i($this->entitiesErrorMessage)->append("\n data (exported): ".wp_json_encode($entitesData))); 
        }

        return $this->factory->createEntities($entitesData, $parameters);       
    } 
}