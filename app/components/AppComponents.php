<?php

namespace AutomatedEmails\App\Components;

use AutomatedEmails\App\Components\Abilities\ComponentsRegistrator;
use AutomatedEmails\App\Components\Abilities\MultipleComponentsProvider;
use AutomatedEmails\Original\Collections\Collection;

class AppComponents
{
    public function __construct(
        protected Collection $componentRegistrators = new Collection([])
    ) {}

    public function addRegistrator(ComponentsRegistrator $componentsRegistrator) : void
    {
        $this->componentRegistrators->push($componentsRegistrator);
    }

    public function registrator(string $id) : ComponentsRegistrator
    {
        return $this->componentRegistrators->find(
            fn(ComponentsRegistrator $componentsRegistrator) => $componentsRegistrator->id()
                                                                                      ->is($id)
        );
    }

    public function register(MultipleComponentsProvider $multipleComponentsProvider) : void
    {
        (object) $compatibleComponentRegistrators = $this->componentRegistrators->getThoseThat(
            canRegisterUsing: $multipleComponentsProvider
        );

        $compatibleComponentRegistrators->perform(registerUsing: $multipleComponentsProvider);
    }
}

