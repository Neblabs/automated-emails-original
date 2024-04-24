<?php

namespace AutomatedEmails\Original\Creators\Model\Gateway;

use AutomatedEmails\Original\Creators\ModelTemplateProjectFileCreator;
use AutomatedEmails\Original\Creators\Model\ModelMeta;

Class GatewayFileCreator extends ModelTemplateProjectFileCreator
{
    protected function getModelTypeName() : string
    {
        return 'gateway';
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/gatewayTemplate.php';
    }
}