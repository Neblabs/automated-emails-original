<?php

namespace AutomatedEmails\Original\Creators\Model\Domain\EntityTemplate;

use AutomatedEmails\Original\Creators\ClassFileCreator;
use AutomatedEmails\Original\Creators\Model\ModelMeta;

Class EntityTemplateFileCreator extends ClassFileCreator
{
    public function __construct(
        protected ModelMeta $modelMeta
    )
    {
    }

    protected function getClassName() : string
    {
        return "{$this->modelMeta->getNameSingular()}Template";
    }

    protected function getRelativeDirectory() : string
    {
        return "{$this->modelMeta->getDirectory()}/templates";
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/EntityTemplateTemplate.php';
    }

    protected function getVariablestoPassToTemplate() : array
    {
        return [
            'modelMeta' => $this->modelMeta
        ];
    }

    protected function getDataToPassToTasks() : array
    {
        (array) $customData = [
        ];

        return array_merge(parent::getDataToPassToTasks(), $customData, $this->getTemplateVariables());
    }
}