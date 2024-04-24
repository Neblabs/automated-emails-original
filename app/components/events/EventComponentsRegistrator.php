<?php

namespace AutomatedEmails\App\Components\Events;

use AutomatedEmails\App\Components\Abilities\ComponentsRegistrator;
use AutomatedEmails\App\Components\Abilities\Groupable;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\MultipleComponentsProvider;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\BaseComponentsRegistrator;
use AutomatedEmails\App\Domain\Events\Event;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Validators\ItemsAreOnlyInstancesOf;
use AutomatedEmails\Original\Collections\Validators\ItemsHaveObjectTypeOf;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Filters\isInstanceOf;
use function AutomatedEmails\Original\Utilities\Text\i;

class EventComponentsRegistrator extends BaseComponentsRegistrator implements ComponentsRegistrator
{
    public function id() : StringManager
    {
        return i('events');
    }

    public function canRegisterUsing(MultipleComponentsProvider $multipleComponentsProvider) : bool
    {
        return $multipleComponentsProvider instanceof EventComponents;
    } 

    /** @param EventComponents $multipleComponentsProvider */
    protected function componentsToRegister(MultipleComponentsProvider $multipleComponentsProvider) : Collection
    {
        return $multipleComponentsProvider->events();
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
                allowedTypes: _(Groupable::class)
            ),
            new ItemsHaveObjectTypeOf(
                items: $componentsToRegister->filter(isInstanceOf(Typeable::class))
                                            ->mapUsing(type: null),
                allowedTypes: _(Event::class)
            )
        ]);
    }
}