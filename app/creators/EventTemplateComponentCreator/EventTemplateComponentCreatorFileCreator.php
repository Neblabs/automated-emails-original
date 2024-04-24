<?php

namespace AutomatedEmails\App\Creators\EventTemplateComponentCreator;

use AutomatedEmails\Original\Creators\ClassFileCreator;

Class EventTemplateComponentCreatorFileCreator extends ClassFileCreator
{
    protected function getClassName() : string
    {
        return '';
    }

    protected function getRelativeDirectory() : string
    {
        return '';
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/EventTemplateComponentCreatorTemplate.php';
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