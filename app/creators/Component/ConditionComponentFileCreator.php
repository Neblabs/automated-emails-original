<?php

namespace AutomatedEmails\App\Creators\Component;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Characters\Suffixed;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\ClassFileCreator;

use function AutomatedEmails\Original\Utilities\Collection\a;
use function AutomatedEmails\Original\Utilities\Text\i;

Class ConditionComponentFileCreator extends ClassFileCreator
{
    protected StringManager $componentNameWithPrefix;
    protected Collection $features;

    public function __construct(
        protected string $componentNameNoSuffix,
        protected string $componentNameWithSuffix,
        protected string $relativeDirectory,
        protected Collection $conditionClass
    ) {}
    
    //a collection of short interface names
    public function setFeatures(Collection $features) : void
    {
        $this->features = $features->map(fn($feature) => ucfirst($feature));
    }

    protected function getClassName() : string
    {
        return $this->componentNameWithSuffix;
    }

    protected function getRelativeDirectory() : string
    {
        return $this->relativeDirectory;
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/ConditionComponentTemplate.php';
    }

    protected function getVariablestoPassToTemplate() : array
    {
        return a(
            componentNameWithSuffix: $this->componentNameWithSuffix,
            componentNameWithoutSuffix: $this->componentNameNoSuffix,
            features: $this->features,
            implementsImports: $this->features->map(
                fn(string $shortInterface) => "use AutomatedEmails\App\Components\Abilities\\{$shortInterface};"
            ),
            conditionClass: $this->conditionClass,
        );
    }

    protected function getDataToPassToTasks() : array
    {
        (array) $customData = [
        ];

        return array_merge(parent::getDataToPassToTasks(), $customData, $this->getTemplateVariables());
    }
}