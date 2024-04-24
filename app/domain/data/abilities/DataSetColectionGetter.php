<?php

namespace AutomatedEmails\App\Domain\Data\Abilities;

interface DataSetColectionGetter
{
    public function dataSetCollection() : DataSetCollection; 
}