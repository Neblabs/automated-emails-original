<?php

namespace AutomatedEmails\App\Domain\Data\Post\Values;

use AutomatedEmails\App\Domain\Data\DataForm;
use AutomatedEmails\App\Domain\Data\Post\PostValue;

Class PostURL extends PostValue
{
    public const FORM = DataForm::URL;
    public const ID = 'url';
    
    /**
     * The title of the post
     */
    public function get() : string
    {
        return $this->postData->post()->url();
    }
}