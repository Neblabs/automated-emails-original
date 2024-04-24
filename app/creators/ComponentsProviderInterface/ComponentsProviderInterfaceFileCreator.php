<?php

namespace AutomatedEmails\App\Creators\ComponentsProviderInterface;

use AutomatedEmails\Original\Characters\Suffixed;
use AutomatedEmails\Original\Creators\ClassFileCreator;

use function AutomatedEmails\Original\Utilities\Collection\a;

Class ComponentsProviderInterfaceFileCreator extends ClassFileCreator
{
    public function __construct(
        protected Suffixed $componentsProviderInterfaceName
    ) {}
    
    protected function getClassName() : string
    {
        return $this->componentsProviderInterfaceName->withSuffix();
    }

    protected function getRelativeDirectory() : string
    {
        return "app/components/{$this->componentsProviderInterfaceName->withoutSuffix()->lowerCaseFirst()}";
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/ComponentsProviderInterfaceTemplate.php';
    }

    protected function getVariablestoPassToTemplate() : array
    {
        return a(
            componentsProviderInterfaceName: $this->componentsProviderInterfaceName
        );
    }

    protected function getDataToPassToTasks() : array
    {
        (array) $customData = [
        ];

        return array_merge(parent::getDataToPassToTasks(), $customData, $this->getTemplateVariables());
    }
}