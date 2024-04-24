<?php

namespace AutomatedEmails\Original\Creators\Model\Table;

use AutomatedEmails\Original\Creators\ModelTemplateProjectFileCreator;
use AutomatedEmails\Original\Creators\Model\ModelMeta;

Class TableFileCreator extends ModelTemplateProjectFileCreator
{
    protected function getModelTypeName() : string
    {
        return 'table';
    }
    
    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/TableTemplate.php';
    }
}