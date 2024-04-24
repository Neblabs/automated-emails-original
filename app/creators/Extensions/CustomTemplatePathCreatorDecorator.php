<?php

namespace AutomatedEmails\App\Creators\Extensions;

use AutomatedEmails\Original\Creators\ClassFileCreator;

class CustomTemplatePathCreatorDecorator extends ClassFileCreator
{
    public function __construct(
        protected string $templatePath,
        protected ClassFileCreator $classFileCreator
    ) {}

    protected function getTemplatePath(): string
    {
        return $this->templatePath;   
    } 

    // the rest    
    protected function getClassName(): string
    {
        return $this->classFileCreator->getClassName();   
    } 

    protected function getRelativeDirectory(): string
    {
        return $this->classFileCreator->getRelativeDirectory();   
    } 

    protected function getVariablestoPassToTemplate(): array
    {
        return $this->classFileCreator->getVariablestoPassToTemplate();   
    } 
}

