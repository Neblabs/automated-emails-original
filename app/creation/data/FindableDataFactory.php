<?php

namespace AutomatedEmails\App\Creation\Data;

use AutomatedEmails\App\Creation\Data\DataFactoriesRepository;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\App\Domain\Data\Abilities\FindableData;

class FindableDataFactory
{
    public function __construct(
        protected DataFactoriesRepository $dataFactoriesRepository
    ) {}

    public function get(string $dataTypeId, string|int $dataId, DataSetCollection $dataSetCollection) : FindableData
    {
        return match(is_numeric($dataId)) {
            false => $dataSetCollection->dataSet($dataTypeId),
            true => $this->dataFactoriesRepository->getForDataType($dataTypeId)
        };
    }
}