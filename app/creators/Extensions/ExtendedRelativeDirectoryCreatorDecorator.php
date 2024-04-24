<?php

namespace AutomatedEmails\App\Creators\Extensions;

use AutomatedEmails\Original\Creators\ClassFileCreator;

use function AutomatedEmails\Original\Utilities\Text\i;

class ExtendedRelativeDirectoryCreatorDecorator extends ClassFileCreator
{
    public function __construct(
        protected ClassFileCreator $classFileCreator,
        protected string $prependPath = '',
        protected string $appendPath = '',
    ) {}

    protected function getRelativeDirectory(): string
    {
        (object) $relativeDirectory = i($this->classFileCreator->getRelativeDirectory());

        if ($this->prependPath) {
            $relativeDirectory = $relativeDirectory->prepend(i($this->prependPath)->ensureRight('/')->trimLeft('/'));
        }

        if ($this->appendPath) {
            $relativeDirectory = $relativeDirectory->append(i($this->appendPath)->ensureLeft('/')->trimRight('/'));
        }

        return $relativeDirectory;
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

