<?php

namespace AutomatedEmails\App\Creators\Extensions;

use AutomatedEmails\Original\Creators\ClassFileCreator;

use function AutomatedEmails\Original\Utilities\Text\i;

class CustomRelativeDirectoryCreatorDecorator extends ClassFileCreator
{
    public function __construct(
        protected ClassFileCreator $classFileCreator,
        protected string $relativeDirectory,
    ) {}

    protected function getRelativeDirectory(): string
    {
        return $this->relativeDirectory;
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

    protected function getVariablestoPassToTemplate(): array
    {
        return $this->classFileCreator->getVariablestoPassToTemplate();   
    } 
}

