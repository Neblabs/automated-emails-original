<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Creation\Entities\Automatedemails\AutomatedEmailsFactory;
use AutomatedEmails\App\Creation\Entities\Conditionroots\ConditionsRootEntitiesFactoryFromEmail;
use AutomatedEmails\App\Creation\Entities\Conditionroots\ConditionsRootFromEmailFactory;
use AutomatedEmails\App\Creation\Entities\Conditionroots\ConditionsRootFromTemplateFactory;
use AutomatedEmails\App\Creation\Entities\ContentFactory;
use AutomatedEmails\App\Creation\Entities\Events\FromWordPressSQLParametersEventFactory;
use AutomatedEmails\App\Creation\Entities\OverloadedEntitiesFactory;
use AutomatedEmails\App\Creation\Entities\Recipients\RecipientEntitiesFromEmailFactory;
use AutomatedEmails\App\Creation\Entities\Recipients\RecipientsFromEmailFactory;
use AutomatedEmails\App\Data\Finders\Automatedemails\AutomatedEmailsFinder;
use AutomatedEmails\App\Data\Finders\Automatedemails\AutomatedEmailsStructure;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Data\Drivers\SQL\WordPressDatabaseReadableDriver;
use AutomatedEmails\Original\Data\Drivers\Wordpress\WordPressPostArrayReadableDriver;
use AutomatedEmails\Original\Data\Query\SQLParameters;
use AutomatedEmails\Original\Data\Query\WordPressPostQueryParameters;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;

use function AutomatedEmails\Original\Utilities\Collection\_;

class AutomatedEmailsFinderDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    public function __construct(
        protected AutomatedEmailsStructure $automatedEmailsStructure,
        protected WordPressPostArrayReadableDriver $wordPressPostReadableDriver,
        protected WordPressDatabaseReadableDriver $wordPressDatabaseReadableDriver,
        protected WordPressPostQueryParameters $automatedEmailsPostQueryParameters,
        protected SQLParameters $conditionsRootSQLParameters,
        protected SQLParameters $recipientSQLParameters,
        protected Components $passableCompositeComponents,
        protected Components $conditionComponents,
        protected TemplateFactory $templateFactory,
        protected ConditionsRootFromTemplateFactory $conditionsRootFromTemplateFactory
    ) {}
    
    static public function type(): string
    {
        return AutomatedEmailsFinder::class;   
    } 

    public function create(): AutomatedEmailsFinder
    {
        return new AutomatedEmailsFinder(
            readableDriver: $this->wordPressPostReadableDriver,
            parameters: $this->automatedEmailsPostQueryParameters, 
            entityFactory: new AutomatedEmailsFactory(
                automatedEmailStructure: $this->automatedEmailsStructure,
                templateFactory: $this->templateFactory,
                eventFactory: new OverloadedEntitiesFactory(_(
                    new FromWordPressSQLParametersEventFactory
                )),
                conditionsRootFromEmailFactory: new ConditionsRootFromEmailFactory(
                    readableDriver: $this->wordPressDatabaseReadableDriver,
                    conditionsRootSQLParameters: $this->conditionsRootSQLParameters,
                    conditionsRootEntitiesFactoryFromEmail: new ConditionsRootEntitiesFactoryFromEmail(
                        conditionsRootFromTemplateFactory: $this->conditionsRootFromTemplateFactory
                    )
                ),
                recipientsFromEmailFactory: new RecipientsFromEmailFactory(
                    readableDriver: $this->wordPressDatabaseReadableDriver,
                    parameters: $this->recipientSQLParameters,
                    recipientEntitiesFromEmailFactory: new RecipientEntitiesFromEmailFactory(
                        $this->templateFactory
                    )
                ),
                contentFactory: new ContentFactory
            )
        );
    } 
}