<?php

namespace AutomatedEmails\App\Creators\Event;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Creators\ClassFileCreator;

use function AutomatedEmails\Original\Utilities\Collection\a;

Class EventFileCreator extends ClassFileCreator
{
    public function __construct(
        protected StringManager $eventName,
        protected string $componentName
    ) {}
    
    protected function getClassName() : string
    {
        return $this->eventName->upperCaseFirst();
    }

    protected function getRelativeDirectory() : string
    {
        return "app/domain/events/builtIn";
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/EventTemplate.php';
    }

    protected function getVariablestoPassToTemplate() : array
    {
        return a(
            componentName: $this->componentName
        );
    }

    protected function getDataToPassToTasks() : array
    {
        (array) $customData = [
        ];

        return array_merge(parent::getDataToPassToTasks(), $customData, $this->getTemplateVariables());
    }
}