<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Creation\Abilities\CanCreateEntity;
use AutomatedEmails\App\Domain\Conditions\Abilities\Passable;
use AutomatedEmails\App\Domain\Conditions\PassableComposite;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\PassedCollection;
use AutomatedEmails\Original\Collections\Validators\ItemsAreOnlyInstancesOf;
use AutomatedEmails\Original\Collections\Validators\ValidatedItems;

use function AutomatedEmails\Original\Utilities\Collection\_;

class PassableCompositeFactory implements CanCreateEntity
{
    protected Collection $passableItems;

    public function __construct(
        protected Components $passableCompositeComponents,
    ) {
        $this->passableItems = _();
    }

    public function setPassablesToAdd(Collection $passableItems) : void
    {
        $this->passableItems = $passableItems;

    }
    /** @param string $data the identifier */
    public function createEntity(mixed $data): PassableComposite
    {
        (object) $passableCompositeComponent = $this->passableCompositeComponents->withId(
            $data
        );

        (string) $PassableComposite = $passableCompositeComponent->type();

        /** @var PassableComposite */
        (object) $passableComposite = new $PassableComposite(_());

        $passableComposite->add(new ValidatedItems(
            items: $this->passableItems,
            validator: new ItemsAreOnlyInstancesOf(
                items: $this->passableItems,
                allowedTypes: _(Passable::class)
            )
        ));

        $this->passableItems = _();

        return $passableComposite;
    } 
}