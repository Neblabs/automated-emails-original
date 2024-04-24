<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Creation\Data\DataFactoriesRepository;
use AutomatedEmails\App\Creation\Data\FindableDataFactory;
use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;

use function AutomatedEmails\Original\Utilities\Collection\_;

class TemplateFactoryDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    static public function type(): string
    {
        return TemplateFactory::class;
    } 

    public function create(): TemplateFactory
    {
        return new TemplateFactory(
            new FindableDataFactory(
                new DataFactoriesRepository(_())
            )
        );
    } 
}