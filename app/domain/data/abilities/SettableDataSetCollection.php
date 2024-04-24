<?php

namespace AutomatedEmails\App\Domain\Data\Abilities;

interface SettableDataSetCollection
{
    public function setData(DataSetCollection $dataSetCollection) : void; 
}