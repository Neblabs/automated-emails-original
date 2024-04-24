<?php

namespace AutomatedEmails\App\Domain\Data\Abilities;

use AutomatedEmails\App\Domain\Data\DataCollection;

interface DataSetCollection
{
    /**
     * Get the DataCollection of a particular id, like 'post' or 'user'.
     *
     *  IMPORTANT TO THROW AN EXCEPTION!
     *  
     * @throws \InvalidArgumentException if the dataTypeId does not exist in the set.
     */
    public function dataSet(string $dataTypeId) : DataCollection;
}