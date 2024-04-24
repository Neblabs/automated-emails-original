<?php

return <<<TEMPLATE
<?php

namespace {$namespace};

use AutomatedEmails\Original\Creators\TemplateProjectFileCreator;

Class {$className} extends TemplateProjectFileCreator
{
    protected function getFileName() : string
    {
        return '';
    }

    protected function getRelativeDirectory() : string
    {
        return '';
    }

    protected function getFileContents() : string
    {
        return '';
    }

}
TEMPLATE;
