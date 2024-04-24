<?php

namespace AutomatedEmails\Original\Core\Services;

use AutomatedEmails\Original\Core\Abilities\Service;
use AutomatedEmails\Original\Core\Abilities\ServicesContainer;
use AutomatedEmails\Original\Error\Abilities\GlobalErrorHandler;
use AutomatedEmails\Original\Events\Wordpress\Hooks;
use Exception;
use Spatie\Ignition\Ignition;

class ErrorHandlerService implements Service
{
    public function id(): string
    {
        return 'error-handler';
    } 

    public function start(ServicesContainer $servicesContainer): void
    {
        /** @var DependenciesService */
        (object) $dependenciesService = $servicesContainer->runningServices()->get('dependencies');
        (object) $dependenciesContainer = $dependenciesService->container();

        /** @var GlobalErrorHandler */
        (object) $errorHandler = $dependenciesContainer->get(GlobalErrorHandler::class);

        $errorHandler->register();
    } 

    public function stop(ServicesContainer $servicesContainer): void
    {
        // unregister the action hooks
    } 
}