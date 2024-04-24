<?php

namespace AutomatedEmails\App\Domain\Posts\Validators;

use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Validator;
use Exception;

use function AutomatedEmails\Original\Utilities\Text\i;

class StatusHasChanged extends Validator
{
    public function __construct(
        protected string $old,
        protected string $new
    ) {}

    public function execute(): ValidationResult
    {
        return $this->passWhen(i($this->old)->isNot($this->new, caseInsensitive: true));
    } 

    protected function getDefaultException(): Exception
    {
        return new Exception("Status '{$this->old}' hasn't changed.");
    } 
}