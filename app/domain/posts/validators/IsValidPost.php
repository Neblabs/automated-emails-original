<?php

namespace AutomatedEmails\App\Domain\Posts\Validators;

use AutomatedEmails\App\Domain\Posts\Post;
use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Exceptions\ValidationException;
use AutomatedEmails\Original\Validation\Validator;
use Exception;

Class IsValidPost extends Validator
{

    public function __construct(
        protected mixed $post
    ) {}
    
    public function execute() : ValidationResult
    {
        return $this->passWhen(
            $this->post instanceof Post && $this->post->isReal()
        );
    }

    protected function getDefaultException() : Exception
    {
        return new ValidationException;
    }
}