<?php

namespace AutomatedEmails\Original\Creators\Model\Model;

use AutomatedEmails\Original\Creators\ModelTemplateProjectFileCreator;
use AutomatedEmails\Original\Creators\Model\ModelMeta;

Class ModelFileCreator extends ModelTemplateProjectFileCreator
{
    protected function getModelTypeName() : string
    {
        return 'model';
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/ModelTemplate.php';
    }
}