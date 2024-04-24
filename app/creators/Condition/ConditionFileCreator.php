<?php

namespace AutomatedEmails\App\Creators\Condition;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Creators\ClassFileCreator;

Class ConditionFileCreator extends ClassFileCreator
{
    public function __construct(
        protected StringManager $conditionNameNoSuffix
    ) {}
    
    protected function getClassName() : string
    {
        return $this->conditionNameNoSuffix->upperCaseFirst();
    }

    protected function getRelativeDirectory() : string
    {
        return "app/domain/conditions/builtIn/{$this->conditionNameNoSuffix->lowerCaseFirst()}";
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/ConditionTemplate.php';
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