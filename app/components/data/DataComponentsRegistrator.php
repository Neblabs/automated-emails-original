<?php

namespace AutomatedEmails\App\Components\Data;

use AutomatedEmails\App\Components\Abilities\ComponentsRegistrator;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\MultipleComponentsProvider;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Provider;
use AutomatedEmails\App\Components\BaseComponentsRegistrator;
use AutomatedEmails\App\Components\Data\DataTypeComponents;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Validators\ItemsAreOnlyInstancesOf;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\i;

class DataComponentsRegistrator extends BaseComponentsRegistrator implements ComponentsRegistrator
{
    public function id() : StringManager
    {
        return i('data');
    }

    public function canRegisterUsing(MultipleComponentsProvider $multipleComponentsProvider) : bool
    {
        return $multipleComponentsProvider instanceof DataTypeComponents;
    } 

    /** @param DataComponents $multipleComponentsProvider */
    protected function componentsToRegister(MultipleComponentsProvider $multipleComponentsProvider) : Collection
    {
        return $multipleComponentsProvider->data();
    }

    protected function rulesOf(Collection $componentsToRegister) : Validator
    {
        return new Validators([
            new ItemsAreOnlyInstancesOf(
                items: $componentsToRegister,
                allowedTypes: _(Identifiable::class)
            ),
            new ItemsAreOnlyInstancesOf(
                items: $componentsToRegister,
                allowedTypes: _(Nameable::class)
            ),
        ]);
    }
}