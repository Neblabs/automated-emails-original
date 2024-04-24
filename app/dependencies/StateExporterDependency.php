<?php

namespace AutomatedEmails\App\Dependencies;

use AutomatedEmails\App\Components\Exporters\Dashboard\StateExporter;
use AutomatedEmails\App\Data\Finders\ConditionsRoot\ConditionsRootStructure;
use AutomatedEmails\App\Data\Finders\Events\EventStructure;
use AutomatedEmails\App\Data\Finders\Recipients\RecipientStructure;
use AutomatedEmails\App\Data\Savers\Exporters\State\BodyExporter;
use AutomatedEmails\App\Data\Savers\Exporters\State\ConditionsRootExporter;
use AutomatedEmails\App\Data\Savers\Exporters\State\EventExporter;
use AutomatedEmails\App\Data\Savers\Exporters\State\RecipientsExporter;
use AutomatedEmails\App\Data\Savers\Exporters\State\SubjectExporter;
use AutomatedEmails\Original\Abilities\Cached;
use AutomatedEmails\Original\Dependency\Abilities\StaticType;
use AutomatedEmails\Original\Dependency\Dependency;
use AutomatedEmails\Original\Dependency\WillAlwaysMatch;

use function AutomatedEmails\Original\Utilities\Collection\_;

class StateExporterDependency implements Cached, StaticType, Dependency
{
    use WillAlwaysMatch;

    static public function type(): string
    {
        return StateExporter::class;        
    } 

    public function __construct(
        protected EventStructure $eventStructure,
        protected ConditionsRootStructure $conditionsRootStructure,
        protected RecipientStructure $recipientStructure,
    ) {}
    
    public function create(): StateExporter
    {
        return new StateExporter(_(
            new EventExporter($this->eventStructure),
            new ConditionsRootExporter($this->conditionsRootStructure),
            new RecipientsExporter($this->recipientStructure),
            new SubjectExporter,
            new BodyExporter,
        ));
    } 
}