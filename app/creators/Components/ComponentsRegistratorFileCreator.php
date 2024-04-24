<?php

namespace AutomatedEmails\App\Creators\Components;

use AutomatedEmails\Original\Characters\Suffixed;
use AutomatedEmails\Original\Creators\ClassFileCreator;
use ReflectionClass;

use function AutomatedEmails\Original\Utilities\Collection\a;

Class ComponentsRegistratorFileCreator extends ClassFileCreator
{
    public function __construct(
        protected Suffixed $componentsRegistratorName,
        protected Suffixed $componentsProviderInterfaceName
    ) {}
    
    protected function getClassName() : string
    {
        return $this->componentsRegistratorName->withSuffix()->get();
    }

    protected function getRelativeDirectory() : string
    {
        return "app/components/{$this->componentsRegistratorName->withoutSuffix()->lowerCaseFirst()}";
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/ComponentsRegistratorTemplate.php';
    }

    protected function getVariablestoPassToTemplate() : array
    {
        return a(
            customComponentsProviderInterface: $this->componentsProviderInterfaceName
        );
    }

    protected function getDataToPassToTasks() : array
    {
        (array) $customData = [
        ];

        return array_merge(parent::getDataToPassToTasks(), $customData, $this->getTemplateVariables());
    }
}