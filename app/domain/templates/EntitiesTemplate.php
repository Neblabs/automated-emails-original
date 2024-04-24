<?php

namespace AutomatedEmails\App\Domain\Templates;

use AutomatedEmails\App\Creation\Templates\EntityTemplateFactory;
use AutomatedEmails\Original\Collections\Collection;
use Exception;
use Error;

use function AutomatedEmails\Original\Utilities\Collection\_;

class EntitiesTemplate
{
    public function __construct(
        protected string $JSONTemplate,
        protected EntityTemplateFactory $entityTemplateFactory
    ) {}

    public function createTemplates() : Collection
    {
        return $this->getTemplateStringsOrThrowException()->map(
            $this->entityTemplateFactory->createEntity(...)
            /*
            fn(string $templateString) => new ($this->entityTemplateClass())(
                $templateString, 
                $this->templateFactory,
                $this->entitiesFactory
            )*/
        );
    }    

    protected function getTemplateStringsOrThrowException() : Collection
    {
        try {
            // the collection needs to be called manually in order for the exception to be thrown
            (object) $templates = new Collection(
                json_decode($this->JSONTemplate) ?? throw new Exception('Invalid JSON')
            );
        } catch (Error $error) {
            throw new Exception(
                message: "Cannot create EntityTemplate instances from template string: {$this->JSONTemplate}. Parent error message: {$error->getMessage()}"
            );
        }

        return $templates;
    }
}