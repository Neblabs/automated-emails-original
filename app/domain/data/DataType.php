<?php

namespace AutomatedEmails\App\Domain\Data;

use AutomatedEmails\Original\Collections\Collection;

abstract class DataType
{
    abstract public function id() : string;
    abstract public function supportedValues() : Collection;

    /**
     * returns a Collection of supported DataForms
     */
    public function supportedForms() : Collection
    {
        return $this->supportedValues()->map(fn(string $dataValueType) : string => $dataValueType::FORM)->withoutDuplicates();
    }
}