<?php

namespace AutomatedEmails\Original\Creators\Model\Domain;

use AutomatedEmails\Original\Creators\Model\ModelComponentMeta;
use AutomatedEmails\Original\Environment\Env;

Class EntityMeta extends ModelComponentMeta
{
    public function getClassName() : string
    {
        return $this->modelMeta->getNameSingular();
    }

    public function getParentClassName() : string
    {
        return 'Entity';   
    }

    public function getParentNamespace() : string
    {
        return Env::getwithBaseNamespace('Original\\Domain');
    }
}