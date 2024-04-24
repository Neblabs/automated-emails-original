<?php

namespace AutomatedEmails\Original\Creators\Model\Domains;

use AutomatedEmails\Original\Creators\ModelTemplateProjectFileCreator;
use AutomatedEmails\Original\Creators\Model\ModelMeta;

Class EntitiesFileCreator extends ModelTemplateProjectFileCreator
{
    protected function getModelTypeName() : string
    {
        return 'entities';
    }

    protected function getVariablestoPassToTemplate() : array
    {
        return array_merge(parent::getVariablestoPassToTemplate(), [
            'testGroup' => 'entity'
        ]);
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/EntitiesTemplate.php';
    }
}