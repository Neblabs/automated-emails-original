<?php

namespace AutomatedEmails\Original\Creators\Model\Model;

use AutomatedEmails\Original\Creators\Model\ModelComponentMeta;

Class ModelMeta extends ModelComponentMeta
{
    public function getClassName() : string
    {
        return "{$this->modelMeta->getNameSingular()}Model";
    }

    public function getParentClassName() : string
    {
        return 'Model';   
    }
}