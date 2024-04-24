<?php

namespace AutomatedEmails\App\Creators\BaseEventCreator;

use AutomatedEmails\App\Components\Builtin\CoreComponents;
use AutomatedEmails\App\Components\Data\DataTypeComponent;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\ClassFileCreator;
use AutomatedEmails\Original\Environment\Env;
use Stringable;
use function AutomatedEmails\Original\Utilities\Collection\a;
use function AutomatedEmails\Original\Utilities\Text\i;

Class BaseEventCreatorFileCreator extends ClassFileCreator
{
    public function __construct(
        protected StringManager $eventName,
        protected string $eventRelativeDirectory,
        protected string $actionHook,
        protected Collection $idsOfdataTypesProvided,
        protected Collection $componentClassName,
    ) {}
    
    protected function getClassName() : string
    {
        return $this->eventName->upperCaseFirst();
    }

    protected function getRelativeDirectory() : string
    {
        return $this->eventRelativeDirectory;
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/BaseEventCreatorTemplate.php';
    }

    protected function getVariablestoPassToTemplate() : array
    {
        return a(
            componentClassName: $this->componentClassName,
            actionHook: $this->actionHook,
            implements: "implements {$this->dataTypeNamesPluralAsCommaList()}",
            traitImports: $this->traitImports()
        );
    }

    protected function getDataToPassToTasks() : array
    {
        (array) $customData = [
        ];

        return array_merge(parent::getDataToPassToTasks(), $customData, $this->getTemplateVariables());
    }

    public function traitImports() : string
    {
        return $this->idsOfdataTypesProvided->map(function(string $dataTypeid) { 
            return "\tuse Get{$this->dataTypeComponentFromId($dataTypeid)->name()}s;";
        }, '')->implode(separator: "\n");
    }

    public function dataTypeNamesPluralAsCommaList() : string
    {
        return $this->idsOfdataTypesProvided->map(function(string $dataTypeid) { 
            return "{$this->dataTypeComponentFromId($dataTypeid)->name()}s";
        }, '')->implode(separator: ", ")->trim(' ');
    }

    public function dataTypeImports() : Stringable
    {
        return $this->idsOfdataTypesProvided->reduce(function(string $template, string $dataTypeid) { 
            /** @var DataTypeComponent */
            (object) $dataTypeComponent = $this->dataTypeComponentFromId($dataTypeid);
            (object) $settings = Env::settings();

            return $template."use {$settings->app->namespace}\App\Domain\Data\\{$dataTypeComponent->name()}\\{$dataTypeComponent->name()}Data;\n".
                   "use {$settings->app->namespace}\App\Domain\Data\\{$dataTypeComponent->name()}\\{$dataTypeComponent->name()}sData;\n".
                   "use {$settings->app->namespace}\App\Domain\Events\SupportedData\\{$dataTypeComponent->name()}s;\n".
                   "use {$settings->app->namespace}\App\Domain\Events\Supporteddata\Get{$dataTypeComponent->name()}s;\n";
        }, '')->trim("\n");
    }

    public function dataTypeProviderMethodDefinitions() : Stringable
    {
        return $this->idsOfdataTypesProvided->reduce(function(string $template, string $dataTypeid)  {
            (object) $dataTypeComponent = $this->dataTypeComponentFromId($dataTypeid);
            return $template.$this->dataMethodTemplate(
                dataTypeComponent: $dataTypeComponent,
            )->append("\n\n");
        }, '')->ensureLeft("\n")
              ->ensureRight("\n");
    }

    protected function dataMethodTemplate(DataTypeComponent $dataTypeComponent) : StringManager
    {
        return i(<<<TEMPLATE
    protected function {$dataTypeComponent->identifier()}s() : {$dataTypeComponent->name()}sData
    {
        return new {$dataTypeComponent->name()}sData([
            //new {$dataTypeComponent->name()}Data(id: 'UpdatedPost', entity: \$post)
        ]);
    }
TEMPLATE);
    }
 
    protected function dataTypeComponentFromId(string $dataTypeid) : DataTypeComponent
    {
        static $coreComponents = new CoreComponents;

        /** @var DataTypeComponent */
        return $coreComponents->dataTypes()->find(
            function(DataTypeComponent $dataTypeComponent) use ($dataTypeid) {
                return i($dataTypeComponent->identifier())->is($dataTypeid);
            }
        );
    }
}