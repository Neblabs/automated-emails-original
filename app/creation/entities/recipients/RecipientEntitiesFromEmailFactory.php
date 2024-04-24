<?php

namespace AutomatedEmails\App\Creation\Entities\Recipients;

use AutomatedEmails\App\Creation\Abilities\CreatableEntitiesWithParameters;
use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Creation\Entities\RecipientsFactory;
use AutomatedEmails\App\Creation\Templates\MetaValueToEntitiesWithParametersFactory;
use AutomatedEmails\App\Creation\Templates\TemplateStringToEntitiesFactory;
use AutomatedEmails\App\Domain\AutomatedEmails\AutomatedEmail;

class RecipientEntitiesFromEmailFactory
{
    public function __construct(
        protected TemplateFactory $templateFactory
    ) {}
    
    public function create(AutomatedEmail $automatedEmail) : CreatableEntitiesWithParameters
    {
        return new MetaValueToEntitiesWithParametersFactory(
            entitiesFactory: new TemplateStringToEntitiesFactory(
                entityTemplateFactory: new RecipientTemplateFactory(
                    templateFactory: $this->templateFactory,
                    entitiesFactory: new RecipientsFactory
                ),
                dataSetCollection: $automatedEmail->event()
            )
        );
    }
}
