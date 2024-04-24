<?php

namespace AutomatedEmails\Original\Creators;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\Creators;
use AutomatedEmails\Original\Creators\Model\Domain\EntitiesTemplate\EntitiesTemplateFileCreator;
use AutomatedEmails\Original\Creators\Model\Domain\EntityFileCreator;
use AutomatedEmails\Original\Creators\Model\Domain\EntityTemplate\EntityTemplateFileCreator;
use AutomatedEmails\Original\Creators\Model\Domains\EntitiesFileCreator;
use AutomatedEmails\Original\Creators\Model\ModelMeta;
use AutomatedEmails\Original\Creators\Tasks\TestFileCreatorTask;
use AutomatedEmails\Original\Language\Classes\Properties;

Class DomainFilesCreator extends Creators
{
    protected $modelMeta;    
    protected $properties;
    protected bool $createEntityTemplateFiles;
    public function __construct(string $singularName, string $pluralName, Properties $properties, bool $createEntityTemplateFiles, string $directoryRelativeToDomain = null)
    {
        $this->modelMeta = new ModelMeta($singularName, $pluralName, $directoryRelativeToDomain);
        $this->createEntityTemplateFiles = $createEntityTemplateFiles;
        $this->properties = $properties;
    }

    protected function getCreators() : Collection
    {
        (object) $creators = Collection::create([
            (object) $entityCreator = new EntityFileCreator($this->modelMeta),
            new EntitiesFileCreator($this->modelMeta),
            $this->createEntityTemplateFiles ? new EntityTemplateFileCreator($this->modelMeta): null,
            $this->createEntityTemplateFiles ? new EntitiesTemplateFileCreator($this->modelMeta): null,
        ])->filter();

        $entityCreator->setProperties($this->properties);
        
        foreach ($creators as $creator) {
            $creator->registerCompletionTasks([
                new TestFileCreatorTask
            ]);
        }

        return $creators; 
    }
}