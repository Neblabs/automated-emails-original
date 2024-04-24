<?php

namespace AutomatedEmails\App\Components;

use AutomatedEmails\App\Components\Abilities\Dependent;
use AutomatedEmails\App\Components\Abilities\Descriptable;
use AutomatedEmails\App\Components\Abilities\HasDependents;
use AutomatedEmails\App\Components\Abilities\HasTemplateOptions;
use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\Original\Abilities\GettableCollection;
use AutomatedEmails\Original\Cache\MemoryCache;
use AutomatedEmails\Original\Collections\Collection;
use PHPUnit\TestRunner\TestResult\Collector;

use function AutomatedEmails\Original\Utilities\Collection\_;

class Components
{
    public function __construct(
        protected Collection $registeredComponents = new Collection([]),
        protected MemoryCache $cache = new MemoryCache
    ) {}
    
    public function add(GettableCollection $components) : void
    {
        $this->registeredComponents->append($components->get());
    }

    public function withId(string $id) : Identifiable|Typeable|Nameable|Descriptable|HasTemplateOptions
    {
        return $this->registeredComponents->find($this->id($id));
    }

    public function has(string $id) : bool
    {
        return $this->registeredComponents->have($this->id($id));
    }

    protected function id(string $id) : callable
    {
        return fn(Identifiable $component) => $component->identifier() === $id;
    }

    public function baseOnly() : self
    {
        // we need to cache it because we only want to add the templates to the parent once.
        // if this method is called twice in the same request, it'd add the same templates every time
        return $this->cache->getIfExists('baseComponents')->otherwise(fn() => new static(
            $this->registeredComponents->filter(
                fn(Identifiable $identifiable) => !$identifiable instanceof Dependent
            )->map(function(Identifiable|HasDependents $baseComponent) {
                if ($baseComponent instanceof HasDependents) {
                    $this->registeredComponents->filter(
                        fn(Identifiable|Dependent $component) => $component instanceof Dependent
                    )->filter(
                        fn(Dependent $dependent) => $dependent->dependsOn() === $baseComponent->identifier()
                    )->forEvery(
                        fn(Dependent&Identifiable $dependent) => $baseComponent->addDependent($dependent)
                    );
                }

                return $baseComponent;
            })->getValues()
        ));
    }
 
    public function all() : Collection
    {
        return clone $this->registeredComponents;
    }
       
    //methods for getting all typeable (for those wuith an implementetion)
    //all nebalme, etc
}