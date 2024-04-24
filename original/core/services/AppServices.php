<?php

namespace AutomatedEmails\Original\Core\Services;

use AutomatedEmails\Original\Abilities\GettableCollection;
use AutomatedEmails\Original\Collections\ByFileGettableCollection;
use AutomatedEmails\Original\Core\Abilities\Service;
use AutomatedEmails\Original\Core\Abilities\ServicesContainer;

class AppServices implements Service
{
    public function __construct(
        protected GettableCollection $registeredAppServices
    ) {}
    
    public function id(): string
    {
        return 'app-services';    
    } 

    public function start(ServicesContainer $servicesContainer): void
    {
        (object) $appServices = $this->registeredAppServices->get();

        $appServices->forEvery($servicesContainer->addService(...));
    } 

    public function stop(ServicesContainer $servicesContainer): void
    {
        
    } 
}