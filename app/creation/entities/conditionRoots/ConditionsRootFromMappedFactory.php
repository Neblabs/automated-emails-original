<?php

namespace AutomatedEmails\App\Creation\Entities\Conditionroots;

use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\App\Creation\Entities\Conditions\PassableCompositeFactory;
use AutomatedEmails\App\Domain\ConditionRoots\ConditionsRoot;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\MappedObject;
use League\CLImate\TerminalObject\Basic\Dump;
use stdClass;


class ConditionsRootFromMappedFactory implements CanCreateEntity
{
    public function __construct(
        protected PassableCompositeFactory $passableCompositeFactory,
        protected CanCreateEntity $subjectConditionFromTemplateFactory
    ) {}
    
    /** @param MappedObject|stdClass $data the mapped template of ConditionsRootTemplate  */
    public function createEntity(mixed $data): ConditionsRoot
    {
        (object) $mappedConditionsRoot = $data;
        (object) $conditionsRoot = new ConditionsRoot;

        (object) $passableCompositeRoot = $this->passableCompositeFactory->createEntity(
            $mappedConditionsRoot->type->get()
        );

        $conditionsRoot->setRoot($passableCompositeRoot);

        /** @var Collection */
        (object) $subjectConditions = $mappedConditionsRoot->subjectConditions->map(
            // we need to re construct the json so that the subject factory can parse it using the  template
            fn($subjectCondition) => $this->subjectConditionFromTemplateFactory->createEntity(
                wp_json_encode($subjectCondition)
            )
        )->forEvery($conditionsRoot->appendSubjectConditions(...));

        return $conditionsRoot;

        //TEST WHEN HAS NO CONDITIONS! IT SHOULD BE TRUE!
    } 
}