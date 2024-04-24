<?php

namespace AutomatedEmails\App\Domain\Data;

use AutomatedEmails\App\Creation\Data\FindableDataFactory;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use InvalidArgumentException;

class Placeholder
{
    /**
     * (([DataType->id].[DataValue::ID]) | Data->id))
     *
     *  TRANSLATES TO:
     *  ((post.title | CreatedPost))
     */
    const PATTERN = '/\(\((\w+)\.(\w+) \| (\w+)\)\)/';

    public function __construct(
        protected string $dataTypeId,
        protected string $dataValueId,
        protected string $dataId,
        protected FindableDataFactory $findableDataFactory
    ) {}

    /**
     * If the placeholder has problems with non-existing ids,
     * we'll jsut render an empty string.
     *
     *Throwing an exception and letting the program halt execution 
     *would have been more useful if this was a templatig engine
     *that would be run in development. But this is run on production,
     *so we need to fail gracefully because we don't want to crash the whole
     *execution just because of a bad placeholder.
     */
    public function render(DataSetCollection $dataSetCollection) : string
    {
        try {
            $renderedValue = $this->tryToRender($dataSetCollection);
        } catch (InvalidArgumentException) {
            (string) $renderedValue = '';
        }

        return $renderedValue;   
    }

    protected function tryToRender(DataSetCollection $dataSetCollection) : string
    {
        (object) $findable = $this->findableDataFactory->get(
            $this->dataTypeId,
            $this->dataId,
            $dataSetCollection
        );

        (object) $data = $findable->withId($this->dataId);
        (object) $value = $data->value($this->dataValueId);

        return $value->get();   
    }
}