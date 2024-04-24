<?php

namespace AutomatedEmails\App\Domain\Data;

use AutomatedEmails\App\Creation\Data\FindableDataFactory;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;
use InvalidArgumentException;

use function AutomatedEmails\Original\Utilities\Text\i;
use function AutomatedEmails\Original\Utilities\validate;

class DataTemplate
{
    public const PATTERN = '/\[(\w+) \| (\w+)\]/';

    protected StringManager $template;

    /**
     * Template:
     *  [post | id]
     */
    public function __construct(
        string $template,
        protected FindableDataFactory $findableDataFactory
    ) {
        $this->template = i($template);

        $this->validateTemplate();
    }

    public function getData(DataSetCollection $eventData) : Data
    {
        [$dataTypeId, $dataId] = $this->template->matches(static::PATTERN)->asArray();

        (object) $findableData = $this->findableDataFactory->get(
            $dataTypeId, 
            $dataId,
            $eventData
        );

        return $findableData->withId($dataId);
    }

    public function validateTemplate() : void
    {
        //dump($this->template);
        validate(
            (new ValidWhen(
                $this->template->matchesRegEx(static::PATTERN)
            ))->withException(
                new InvalidArgumentException("Invalid (DataTemplate) template: {$this->template}. Template must follow pattern: ".static::PATTERN)
            )
        );
    }
}