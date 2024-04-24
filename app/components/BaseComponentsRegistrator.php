<?php

namespace AutomatedEmails\App\Components;

use AutomatedEmails\App\Components\Abilities\MultipleComponentsProvider;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Validators\ValidatedItems;
use AutomatedEmails\Original\Validation\Validator;

abstract class BaseComponentsRegistrator
{
    abstract protected function rulesOf(Collection $componentsToRegister) : Validator;
    abstract protected function componentsToRegister(MultipleComponentsProvider $multipleComponentsProvider) : Collection;

    public function __construct(
        protected Components $components
    ) {}
    
    public function components() : Components
    {
        return $this->components;
    } 

    public function registerUsing(MultipleComponentsProvider $multipleComponentsProvider) : void
    {
        (object) $componentsToRegister = $this->componentsToRegister($multipleComponentsProvider);

        $this->components->add(new ValidatedItems(
            items: $componentsToRegister,
            validator: $this->rulesOf($componentsToRegister)
        ));
    }
}