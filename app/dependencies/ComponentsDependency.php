<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Components\AppComponents;
use AutomatedEmails\App\Components\Components;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Abilities\UnCached;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\Abilities\Context;

use function AutomatedEmails\Original\Utilities\Collection\_;

class ComponentsDependency implements UnCached, StaticType, Dependency
{
    protected const COMPONENTS = [
        'eventComponents' => 'events',
        'conditionComponents' => 'conditions',
        'dataTypeComponents' => 'dataTypes',
        'dataComponents' => 'data',
        'passableCompositeComponents' => 'passableComposites',
    ];

    protected Context $context;

    public function __construct(
        protected AppComponents $appComponents
    ) {}
    
    static public function type(): string
    {
        return Components::class;   
    } 

    public function canBeCreated(Context $context): bool
    {
        $this->context = $context;
        
        return _(self::COMPONENTS)->getKeys()->have(
            fn(string $variableName) => $context->nameIs($variableName)
        ); 
    } 

    public function create(): Components
    {
        (string) $registratorId = _(self::COMPONENTS)->find(
            fn(string $componentId, string $variableName) => $this->context->nameIs($variableName)
        );

        (object) $registrator = $this->appComponents->registrator($registratorId);

        return $registrator->components();
    } 
}