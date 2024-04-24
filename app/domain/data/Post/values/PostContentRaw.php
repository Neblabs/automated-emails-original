<?php

namespace AutomatedEmails\App\Domain\Data\Post\Values;

use AutomatedEmails\App\Domain\Data\DataForm;
use AutomatedEmails\App\Domain\Data\Post\PostValue;

Class PostContentRaw extends PostValue
{
    public const FORM = DataForm::TEXT;
    public const ID = 'contentRaw';
    
    /**
     * The title of the post
     */
    public function get() : string
    {
        return $this->postData->post()->contentRaw();
    }
}