<?php

namespace AutomatedEmails\Original\Creators\Model\Gateway;

use AutomatedEmails\Original\Creators\Model\ModelComponentMeta;

Class GatewayMeta extends ModelComponentMeta
{
    public function getClassName() : string
    {
        return "{$this->modelMeta->getNamePlural()}Gateway";
    }

    public function getParentClassName() : string
    {
        return 'Gateway';   
    }
}