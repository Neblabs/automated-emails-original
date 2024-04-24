<?php

namespace AutomatedEmails\App\Creators\BaseEventComponentCreator;

use AutomatedEmails\App\Components\Data\Builtin\Post\PostDataTypeComponent;
use AutomatedEmails\App\Components\Data\DataTypeComponent;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\ClassFileCreator;
use AutomatedEmails\Original\Environment\Env;
use Stringable;
use function AutomatedEmails\Original\Utilities\Collection\a;
use function AutomatedEmails\Original\Utilities\Text\i;

Class BaseEventComponentFileCreator extends ClassFileCreator
{
    public function __construct(
        protected string $eventName,
        protected string $eventRelativeDirectory,
        protected string $eventReadableName,
        protected Collection $postDataTypeComponents,
    ) {}
    
    protected function getClassName() : string
    {
        return i($this->eventName)->append("Component")->get();
    }

    protected function getRelativeDirectory() : string
    {
        return "app/components/events/builtIn/{$this->eventName}";
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/BaseEventComponentCreatorTemplate.php';
    }

    protected function getVariablestoPassToTemplate() : array
    {
        return a(
            eventName: $this->eventName,
            eventReadableName: $this->eventReadableName,
            eventNamespace: i($this->eventRelativeDirectory)->explode("/")->map(fn(string $directoryName) => i($directoryName)->upperCaseFirst())->implode("\\")->prepend(Env::settings()->app->namespace."\\"),
            postDataTypeComponentImports: $this->postDataTypeComponentImports(),
            postDataTypeImportedClassNameList: $this->postDataTypeImportedClassNameList(),
        );
    }

    protected function postDataTypeComponentImports() : Stringable
    {
        return $this->postDataTypeComponents->map(
            fn(DataTypeComponent $dataTypeComponent) => "use ".$dataTypeComponent::class.";"
        )->implode("\n");
    }

    protected function postDataTypeImportedClassNameList() : Stringable
    {
        return $this->postDataTypeComponents->map(
            fn(DataTypeComponent $dataTypeComponent) => i($dataTypeComponent::class)->explode("\\")->last()->append("::class,")->prepend("\t\t\t\t")
        )->implode("\n")->trim(",");
    }
    
    protected function getDataToPassToTasks() : array
    {
        (array) $customData = [
        ];

        return array_merge(parent::getDataToPassToTasks(), $customData, $this->getTemplateVariables());
    }
}