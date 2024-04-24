<?php

namespace AutomatedEmails\Original\Creators;

use AutomatedEmails\Original\Creators\ClassFileCreator;
use AutomatedEmails\Original\Creators\Model\ModelComponentMeta;
use AutomatedEmails\Original\Creators\Model\ModelMeta;
use AutomatedEmails\Original\Environment\Env;

Abstract Class ModelTemplateProjectFileCreator extends ClassFileCreator
{
    protected $modelMeta;

    abstract protected function getModelTypeName() : string;

    public function __construct(ModelMeta $modelMeta)
    {
        $this->modelMeta = $modelMeta;
    }

    protected function getFileContents() : string
    {
        extract($this->getVariablestoPassToTemplate());

        return require $this->getTemplatePath();
    }

    protected function getVariablestoPassToTemplate() : array
    {
        return [
            'settings' => Env::settings(),
            'modelMeta' => $this->modelMeta,
            'currentModelMeta' => $this->getCurrentModelMeta()
        ];
    }

    protected function getCurrentModelMeta() : ModelComponentMeta
    {
        return $this->modelMeta->getForComponent($this->getModelTypeName());   
    }
    
    protected function getRelativeDirectory() : string
    {
        return $this->modelMeta->getDirectory();
    }

    protected function getClassName() : string
    {
        return $this->getCurrentModelMeta()->getClassName();
    }
}