<?php

namespace AutomatedEmails\App\Creation\Data;

use AutomatedEmails\App\Creation\DataFactory;
use AutomatedEmails\Original\Collections\Collection;
use OutOfBoundsException;

class DataFactoriesRepository
{
    public function __construct(
        protected Collection $factories
    ) {}

    public function getForDataType(string $dataTypeId) : DataFactory
    {
        return $this->factories->get($dataTypeId) 
                ?? 
        throw new OutOfBoundsException("Unexistent data dataTypeId: {$dataTypeId}");
    }
}