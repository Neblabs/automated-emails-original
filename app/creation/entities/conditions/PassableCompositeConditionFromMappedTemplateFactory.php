<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Creation\Abilities\CanCreateEntities;
use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Domain\Conditions\PassableComposite;
use AutomatedEmails\Original\Collections\MappedObject;
use AutomatedEmails\Original\Collections\PassedCollection;
use AutomatedEmails\Original\Collections\Validators\ItemsAreOnlyInstancesOf;
use AutomatedEmails\Original\Collections\Validators\ValidatedItems;
use AutomatedEmails\Original\Domain\Entity;

class PassableCompositeConditionFromMappedTemplateFactory implements CanCreateEntity
{
    public function __construct(
        protected Components $passableCompositeComponents,
        protected CanCreateEntities $conditionsFromTemplateFactory,
        protected PassableCompositeFactory $passableCompositeFactory
    ) {}

    /** @param MappedObject|stdClass $data */
    public function createEntity(mixed $data): PassableComposite
    {
        (object) $mappedPassableComposite = $data;

        $this->passableCompositeFactory->setPassablesToAdd(
            $this->conditionsFromTemplateFactory->createEntities(
                $mappedPassableComposite->conditions->map(fn($condition) => wp_json_encode($condition))
                                                    ->asJson()
                                                    ->get()
            )->asCollection()
        );

        (object) $passableComposite = $this->passableCompositeFactory->createEntity(
            $mappedPassableComposite->type
        );

        return $passableComposite;
    } 
}