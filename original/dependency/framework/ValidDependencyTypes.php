<?php

namespace AutomatedEmails\Original\Dependency\Framework;

use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Abilities\GettableCollection;
use AutomatedEmails\Original\Abilities\UnCached;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Validators\ItemsHaveObjectTypeOf;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\Exceptions\InvalidDependencyException;
use AutomatedEmails\Original\Validation\Validators;
use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\validate;

class ValidDependencyTypes implements GettableCollection
{
    protected Collection $dependencyTypes;

    public function __construct(
        protected GettableCollection $dependencyTypesGetter
    ) 
    {
        $this->dependencyTypes = $this->dependencyTypesGetter->get();

        validate(
            new Validators([
                (new ItemsHaveObjectTypeOf(
                    items: $this->dependencyTypes, 
                    allowedTypes: _(
                        Dependency::class
                    )
                ))->withException(
                    new InvalidDependencyException("One or more of your dependencies do not implement ".Dependency::class)
                ),
                (new ItemsHaveObjectTypeOf(
                    items: $this->dependencyTypes, 
                    allowedTypes: _(
                        StaticType::class
                    )
                ))->withException(
                    new InvalidDependencyException("One or more of your dependencies do not implement ".StaticType::class.". Direct Dependency classes may only implement StaticType.")
                ),
                //
                (new ItemsHaveObjectTypeOf(
                    items: $this->dependencyTypes, 
                    allowedTypes: _(
                        UnCached::class,
                        Cached::class
                    )
                ))->withException(new InvalidDependencyException("Each Dependency must implement either ".UnCached::class." or ".Cached::class))
            ])
        );
    }
    
    public function get(): Collection
    {
        return $this->dependencyTypes;
    } 
}