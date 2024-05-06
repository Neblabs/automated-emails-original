<?php

use AutomatedEmails\Original\Construction\Core\DevelopmentServiceExceptionHandlerFactory;
use AutomatedEmails\Original\Construction\Core\ProductionServiceExceptionHandlerFactory;

return [
    DevelopmentServiceExceptionHandlerFactory::class,
    ProductionServiceExceptionHandlerFactory::class,
];