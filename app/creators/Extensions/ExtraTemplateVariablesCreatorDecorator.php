<?php

namespace AutomatedEmails\App\Creators\Extensions;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\ClassFileCreator;

use function AutomatedEmails\Original\Utilities\Text\i;

class ExtraTemplateVariablesCreatorDecorator extends ClassFileCreator
{
    public function __construct(
        protected ClassFileCreator $classFileCreator,
        protected array $templateVariables,
    ) {}

    protected function getVariablestoPassToTemplate(): array
    {
        return [
            ...$this->classFileCreator->getVariablestoPassToTemplate(),
            ...$this->templateVariables
        ];   
    } 

    // the rest    
    protected function getClassName(): string
    {
        return $this->classFileCreator->getClassName();   
    } 

    protected function getTemplatePath(): string
    {
        return $this->classFileCreator->getTemplatePath();   
    } 

    protected function getRelativeDirectory(): string
    {
        return $this->classFileCreator->getRelativeDirectory();   
    } 
}

