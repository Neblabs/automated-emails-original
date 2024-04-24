<?php

namespace AutomatedEmails\App\Creation;

use AutomatedEmails\App\Domain\Data\DataValues;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\App\Domain\Data\DataValue;

abstract class DataValuesFactory
{
    abstract protected function dataValuesClassName() : string;
     
    public function __construct(
        protected Data $data
    ) {}

    public function create() : DataValues
    {
        (object) $dataValues = $this->data->type()->supportedValues()->map(
            fn(string $DataValueType) : DataValue => $this->createDataValue($DataValueType)
        );

        (string) $dataValuesClassName = $this->dataValuesClassName();
        
        return new $dataValuesClassName($dataValues);
    }

    public function createDataValue(string $DataValueType) : DataValue
    {
        return new $DataValueType($this->data);
    }
}