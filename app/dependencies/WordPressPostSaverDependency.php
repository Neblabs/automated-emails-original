<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Data\Finders\ConditionsRoot\ConditionsRootStructure;
use AutomatedEmails\App\Data\Finders\Events\EventStructure;
use AutomatedEmails\App\Data\Finders\Recipients\RecipientStructure;
use AutomatedEmails\App\Data\Savers\Automatedemails\ConditionsRootSaverDataProvider;
use AutomatedEmails\App\Data\Savers\Automatedemails\EventSaverDataProvider;
use AutomatedEmails\App\Data\Savers\Automatedemails\RecipientsSaverDataProvider;
use AutomatedEmails\App\Data\Savers\WordpressPostMetaSaverFromDataProvider;
use AutomatedEmails\App\Data\Savers\WordPressPostSaver;
use AutomatedEmails\App\Data\Savers\WordPressPostSaverComposite;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;

use function AutomatedEmails\Original\Utilities\Collection\_;

/**
 * These are the savers that save Automated Email post meta data
 */
class WordPressPostSaverDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    static public function type(): string
    {
        return WordPressPostSaver::class;
    } 

    public function __construct(
        protected RecipientStructure $recipientStructure,
        protected EventStructure $eventStructure,
        protected ConditionsRootStructure $conditionsRootStructure
    ) {}
    
    public function create(): WordPressPostSaverComposite
    {
        return new WordPressPostSaverComposite(_(
            new WordpressPostMetaSaverFromDataProvider(
                new RecipientsSaverDataProvider($this->recipientStructure)
            ),
            new WordpressPostMetaSaverFromDataProvider(
                new EventSaverDataProvider($this->eventStructure)
            ),
            new WordpressPostMetaSaverFromDataProvider(
                new ConditionsRootSaverDataProvider($this->conditionsRootStructure)
            )
        ));
    } 
}