<?php

namespace AutomatedEmails\App\Components\Passable;

use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\ComponentsRegistrator;
use AutomatedEmails\App\Components\Abilities\MultipleComponentsProvider;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\BaseComponentsRegistrator;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Validators\ItemsAreOnlyInstancesOf;
use AutomatedEmails\Original\Collections\Validators\ItemsHaveObjectTypeOf;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators;
use AutomatedEmails\App\Components\Passable\PassableComponents;
use AutomatedEmails\App\Domain\Conditions\PassableComposite;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\i;

class PassableComponentsRegistrator extends BaseComponentsRegistrator implements ComponentsRegistrator
{
    public function id() : StringManager
    {
        return i('passableComposites');
    }

    public function canRegisterUsing(MultipleComponentsProvider $multipleComponentsProvider) : bool
    {
        return $multipleComponentsProvider instanceof PassableComponents;
    } 

    /** @param PassableComponents $multipleComponentsProvider */
    protected function componentsToRegister(MultipleComponentsProvider $multipleComponentsProvider) : Collection
    {
        return $multipleComponentsProvider->passableComposites();
    }

    protected function rulesOf(Collection $componentsToRegister) : Validator
    {
        return new Validators([
            new ItemsAreOnlyInstancesOf(
                items: $componentsToRegister,
                allowedTypes: _(Identifiable::class),
            ),
            new ItemsAreOnlyInstancesOf(
                items: $componentsToRegister,
                allowedTypes: _(Typeable::class),
            ),
            new ItemsAreOnlyInstancesOf(
                items: $componentsToRegister,
                allowedTypes: _(Nameable::class),
            ),
            new ItemsHaveObjectTypeOf(
                items: $componentsToRegister->mapUsing(type: null),
                allowedTypes: _(PassableComposite::class)
            )
        ]);
    }
}
