<?php

namespace AutomatedEmails\App\Creators\Users;

use AutomatedEmails\Original\Creators\TemplateProjectFileCreator;

Class UsersFileCreator extends TemplateProjectFileCreator
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