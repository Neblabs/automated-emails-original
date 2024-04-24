<?php

namespace AutomatedEmails\Original\Creators\Model;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\Model\Domain\DomainMeta;
use AutomatedEmails\Original\Creators\Model\Domain\EntityMeta;
use AutomatedEmails\Original\Creators\Model\Domains\DomainsMeta;
use AutomatedEmails\Original\Creators\Model\Domains\EntitiesMeta;
use AutomatedEmails\Original\Creators\Model\Gateway\GatewayMeta;
use AutomatedEmails\Original\Creators\Model\Model\ModelMeta as ModelMetaComponent;
use AutomatedEmails\Original\Creators\Model\Table\TableMeta;
use AutomatedEmails\Original\Environment\Env;

Class ModelMeta
{
    protected $singularName;
    protected $pluralName;
    protected $modelComponentMetas;

    public function __construct(string $singularName, string $pluralName, string $directoryRelativeToDomain = null)
    {
        $this->singularName =  StringManager::create($singularName)->upperCaseFirst();
        $this->pluralName = StringManager::create($pluralName)->upperCaseFirst();
        $this->directoryRelativeToDomain = $directoryRelativeToDomain ?? $this->getNamePlural()->lowerCaseFirst();
        $this->setModelComponentMetas();
    }

    protected function setModelComponentMetas()
    {
        $this->modelComponentMetas = new Collection([
            'gateway' => new GatewayMeta($this),
            'entity' => new EntityMeta($this),
            'entities' => new EntitiesMeta($this),
            'model' => new ModelMetaComponent($this),
            'table' => new TableMeta($this),
        ]);     
    }

    public function getForComponent(string $modelComponent) : ModelComponentMeta
    {
        return $this->modelComponentMetas->get($modelComponent);
    }
    
    public function getNameSingular() : StringManager
    {
        return $this->singularName;   
    }

    public function getNamePlural() : StringManager
    {
        return $this->pluralName;   
    }
    
    public function getDirectory() : string
    {
        return "app/domain/{$this->directoryRelativeToDomain}";
    }
    
    public function getNamespace() : string
    {
        return Env::getNamespaceFromDirectory($this->getDirectory());
    }
}