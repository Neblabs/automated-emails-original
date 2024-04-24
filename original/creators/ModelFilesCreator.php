<?php

namespace AutomatedEmails\Original\Creators;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\Abilities\Creator;
use AutomatedEmails\Original\Creators\Creators;
use AutomatedEmails\Original\Creators\Model\Domain\EntityFileCreator;
use AutomatedEmails\Original\Creators\Model\Domains\EntitiesFileCreator;
use AutomatedEmails\Original\Creators\Model\Gateway\GatewayFileCreator;
use AutomatedEmails\Original\Creators\Model\ModelMeta;
use AutomatedEmails\Original\Creators\Model\Model\ModelFileCreator;
use AutomatedEmails\Original\Creators\Model\Table\TableFileCreator;
use AutomatedEmails\Original\Environment\Env;

Class ModelFilesCreator extends Creators
{
    protected $modelMeta;    

    public function __construct(string $singularName, string $pluralName)
    {
        $this->modelMeta = new ModelMeta($singularName, $pluralName);   
    }

    protected function getCreators() : Collection
    {
        return new Collection([
            //+new GatewayFileCreator($this->modelMeta),
            //out: new EntityFileCreator($this->modelMeta),
            //out: new EntitiesFileCreator($this->modelMeta),
            //+new ModelFileCreator($this->modelMeta),
            //+new TableFileCreator($this->modelMeta),
        ]);
    }
}