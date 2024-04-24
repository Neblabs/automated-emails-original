<?php

namespace AutomatedEmails\App\Creators\ConditionOptions;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Characters\Suffixed;
use AutomatedEmails\Original\Creators\ClassFileCreator;

Class ConditionOptionsFileCreator extends ClassFileCreator
{
    public function __construct(
        protected StringManager $conditionNameNoSuffix
    ) {}
    
    protected function getClassName() : string
    {
        return $this->conditionNameNoSuffix->ensureRight('Options')->upperCaseFirst();
    }

    protected function getRelativeDirectory() : string
    {
        return "app/domain/conditions/builtIn/{$this->conditionNameNoSuffix->lowerCaseFirst()}";
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/ConditionOptionsTemplate.php';
    }

    protected function getVariablestoPassToTemplate() : array
    {
        return [];
    }

    protected function getDataToPassToTasks() : array
    {
        (array) $customData = [
        ];

        return array_merge(parent::getDataToPassToTasks(), $customData, $this->getTemplateVariables());
    }
}