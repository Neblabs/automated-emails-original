<?php

namespace AutomatedEmails\Original\Deployment\Scripts;

use AutomatedEmails\Original\Construction\Core\ProductionServiceExceptionHandlerFactory;
use AutomatedEmails\Original\Core\Exceptions\Handlers\OriginalServiceExceptionHandlerFactoryTypes;
use AutomatedEmails\Original\Deployment\Script;
use AutomatedEmails\Original\Environment\Env;
use Exception;
use function AutomatedEmails\Original\Utilities\Text\i;

Class DevelopmentServiceExceptionHandlerFactoryRemoverScript extends Script
{
    public function run()
    {
        (string) $copyDirectoryName = $this->data->get('copyDirectoryName');

        (object) $file = new OriginalServiceExceptionHandlerFactoryTypes;
        (object) $originalFilePath = i($file->source());
        (object) $targetFilePath = $originalFilePath->replace(
            search: Env::originalDirectory(), 
            replacement: "{$copyDirectoryName}/original"
        );

        //dump($copyDirectoryName, $originalFilePath->get(), $targetFilePath->get());

        if (!file_exists($targetFilePath->get())) {
            throw new Exception('file not found');
        }

        file_put_contents(
            $targetFilePath, 
            data: ("<?php\n\nreturn ".var_export([ProductionServiceExceptionHandlerFactory::class], return: true).';')
        );
    }
    
}