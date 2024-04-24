<?php

namespace AutomatedEmails\App\Domain\Data;

use AutomatedEmails\App\Domain\Data\DataValue;
use AutomatedEmails\Original\Domain\Entities;
use InvalidArgumentException;

abstract class DataValues extends Entities
{
    /**
     * @throws InvalidArgumentException
     */
    public function value(string $id) : DataValue
    {
        /*mixed*/ $value =  $this->entities->find(
            fn(DataValue $dataValue) => $dataValue->id() === $id
        );

        return $value ?? throw new InvalidArgumentException("Unknown DataValue: {$id}");
    }
}