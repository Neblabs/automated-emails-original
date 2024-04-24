<?php

namespace AutomatedEmails\Original\Dependency;

use AutomatedEmails\Original\Cache\Cache;
use AutomatedEmails\Original\Cache\MemoryCache;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Abilities\ContextFactory;
use AutomatedEmails\Original\Dependency\Abilities\DynamicType;
use AutomatedEmails\Original\Dependency\Abilities\Context;

use ReflectionClass;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Collection\a;

class Dependent implements Dependency, DynamicType
{
    protected DependenciesContainer $dependenciesContainer;

    public function __construct(
        protected DynamicType $dynamicType,
        protected ContextFactory $contextFactory,
        protected Cache $cache = new MemoryCache
    ) {
    }
    
    public function type(): string
    {
        return $this->dynamicType->type();    
    } 

    public function defaultType(): string
    {
        return $this->dynamicType->defaultType();
    } 

    public function setDependenciesContainer(DependenciesContainer $dependenciesContainer): void
    {
        $this->dependenciesContainer = $dependenciesContainer;
    } 

    public function canBeCreated(Context $context): bool
    {
        return class_exists($this->dynamicType->type()) && $this->parametersAreAllTyped();
    } 

    public function parametersAreAllTyped() : bool
    {
        (object) $dependencyTypes = $this->dependencyTypesAndContexts();

        (object) $nonTypedArgument = fn(Collection $dependencyTypeAndContext) => !(
            is_string($dependencyTypeAndContext->get('type')) && (
                class_exists($dependencyTypeAndContext->get('type')) || interface_exists($dependencyTypeAndContext->get('type'))
            )
        );

        return $dependencyTypes->haveNone() || $dependencyTypes->doesNotHave($nonTypedArgument);
    }

    public function create(): object
    {
        (string) $defaultType = $this->dynamicType->defaultType();

        return new $defaultType(...$this->dependencies()->asArray());
    } 

    protected function dependencies() : Collection
    {
        return $this->dependencyTypesAndContexts()->map(
            fn(Collection $dependencyTypeAndContext) => $this->dependenciesContainer->get(
                $dependencyTypeAndContext->get('type'),
                $dependencyTypeAndContext->get('context')
            )
        );
    }

    protected function dependencyTypesAndContexts() : Collection
    {
        (string) $type = $this->dynamicType->defaultType();

        $reflectionClass = new ReflectionClass($type);

        $constructor = $reflectionClass->getConstructor();

        return $this->cache->getIfExists($type)->otherwise(
            function() use($type) {
                $reflectionClass = new ReflectionClass($type);

                $constructor = $reflectionClass->getConstructor();

                return _($constructor?->getParameters() ?? [])->map(
                    fn($parameter) => _(a(
                        type: (string) $parameter->getType(),
                        context: $this->contextFactory->create($parameter)
                    ))
                );
            }
        );
    }
    
}