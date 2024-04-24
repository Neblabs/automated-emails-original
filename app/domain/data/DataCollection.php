<?php

namespace AutomatedEmails\App\Domain\Data;

use AutomatedEmails\App\Creation\DataFactory;
use AutomatedEmails\App\Domain\Data\Abilities\FindableData;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\App\Domain\Data\DataValue;
use AutomatedEmails\Original\Domain\Entities;

Abstract Class DataCollection extends Entities implements FindableData
{
    /**
     * The type of Data, like 'post' or 'user'.
     */
    abstract public function id() : string;
    abstract protected function getDomainClass() : string;
    abstract protected function dataFactory() : DataFactory;

    /**
     * It will return an empty Data object if no Data with the provided id was found
     */
    public function withId(mixed $id) : Data
    {
        return $this->entities->find(fn(Data $data) : bool => $data->id() === $id) 
                ??
               $this->dataFactory()->createNullDataObject();

    }
}