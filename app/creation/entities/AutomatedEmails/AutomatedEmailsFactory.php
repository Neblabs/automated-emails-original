<?php

namespace AutomatedEmails\App\Creation\Entities\Automatedemails;

use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\App\Creation\Abilities\CreatableEntities;
use AutomatedEmails\App\Creation\Abilities\CreatableEntitiesWithParameters;
use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Creation\Entities\Conditionroots\ConditionsRootFromEmailFactory;
use AutomatedEmails\App\Creation\Entities\Conditions\ConditionsFromEmailFactory;
use AutomatedEmails\App\Creation\Entities\ContentFactory;
use AutomatedEmails\App\Creation\Entities\Recipients\RecipientsFromEmailFactory;
use AutomatedEmails\App\Data\Finders\Automatedemails\AutomatedEmailsStructure;
use AutomatedEmails\App\Domain\AutomatedEmails\AutomatedEmail;
use AutomatedEmails\App\Domain\AutomatedEmails\AutomatedEmails;
use AutomatedEmails\App\Domain\Data\TextTemplate;
use AutomatedEmails\App\Domain\Events\Event;
use AutomatedEmails\Original\Data\Query\Parameters;
use AutomatedEmails\Original\Data\Query\WordPressPostQueryParameters;

use function AutomatedEmails\Original\Utilities\Collection\_;

class AutomatedEmailsFactory implements CreatableEntitiesWithParameters
{
    public function __construct(
        protected AutomatedEmailsStructure $automatedEmailStructure,
        protected TemplateFactory $templateFactory,
        protected CreatableEntities $eventFactory,
        protected CanCreateEntity $conditionsRootFromEmailFactory,
        protected RecipientsFromEmailFactory $recipientsFromEmailFactory,
        protected ContentFactory $contentFactory,
    ) {}

    //WE NEED TO IMPLEMENT THE CREATE_ENTITIES() METHOD!

    /** 
     * @param array $data
     * @param WordPressPostQueryParameters $parameters
     */
    public function createEntity(mixed $data, Parameters $parameters): AutomatedEmail
    {
        (object) $fields = $this->automatedEmailStructure->fields();

        (object) $automatedEmail = new AutomatedEmail(
            id: $data[$fields->field('id')->name()->get()]
        );

        $automatedEmail->setEvent(
            $this->eventFactory->createEntity($parameters)
        );

        $automatedEmail->setCustomConditionsRoot(
            $this->conditionsRootFromEmailFactory->createEntity($automatedEmail)
        );

        $automatedEmail->setRecipients(
            $this->recipientsFromEmailFactory->createEntities($automatedEmail)
        );
        $automatedEmail->setSubject(
            $this->contentFactory->createEntity(
                $this->templateFactory->createTextTemplate(
                    $data[$fields->field('subject')->name()->get()]
                )->render($automatedEmail->event())
            )
        );
        $automatedEmail->setBody(
            $this->contentFactory->createEntity(
                $this->templateFactory->createTextTemplate(
                    $data[$fields->field('body')->name()->get()]
                )->render($automatedEmail->event())
            )
        );

        return $automatedEmail;
    } 

    /** 
     * @param array<array> $entitesData
     */
    public function createEntities(mixed $entitesData, Parameters $parameters): AutomatedEmails
    {
        return new AutomatedEmails(_($entitesData)->map(
            fn(array $data) => $this->createEntity($data, $parameters)
        ));        
    } 
}