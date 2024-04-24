<?php

namespace AutomatedEmails\App\Domain\Data\Post\Values;

use AutomatedEmails\App\Domain\Data\DataForm;
use AutomatedEmails\App\Domain\Data\Post\PostValue;

Class PostID extends PostValue
{
    public const FORM = DataForm::NUMBER;
    public const ID = 'id';
    
    /**
     * The title of the post
     */
    public function get() : int
    {
        return $this->postData->post()->id();
    }
}