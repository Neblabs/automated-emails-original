<?php

namespace AutomatedEmails\Original\Collections\Validators;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Exceptions\InvalidTypeException;
use AutomatedEmails\Original\Validation\ValidationResult;
use AutomatedEmails\Original\Validation\Validator;
use Exception;

class ItemsHaveObjectTypeOf extends Validator
{
    protected ?string $invalidType;

    public function __construct(
        protected Collection $items,
        protected Collection $allowedTypes
    ) {}

    public function execute(): ValidationResult
    {
        return $this->failWhen(
            (boolean) $this->invalidType = $this->items->find(
                fn(mixed $item) => !$this->allowedTypes->have(
                    fn(string $fullyQualifiedTypeName) => is_a(
                        $item, 
                        $fullyQualifiedTypeName, 
                        allow_string: true
                    )
                )
            )
        );
    } 

    protected function getDefaultException(): Exception
    {
        throw new InvalidTypeException(
            "Type: {$this->invalidType} must implement: {$this->allowedTypes->implode(' | ')}"
        );
    } 
}