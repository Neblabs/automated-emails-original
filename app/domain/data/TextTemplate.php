<?php

namespace AutomatedEmails\App\Domain\Data;

use AutomatedEmails\App\Creation\Data\TemplateFactory;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\Original\Characters\StringManager;


use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\i;

class TextTemplate
{
    protected StringManager $template;

    /**
     * Template:
     * (([DataType->id].[DataValue::ID]) | Data->id))
     *
     * eg:
     *
     * ((post.title | CreatedPost))
     */
    public function __construct(
        string $template, 
        protected TemplateFactory $templateFactory
    ) {
        $this->template = i($template);
    }

    public function render(DataSetCollection $dataSetCollection) : string
    {
        return (string) $this->template->replaceRegEx(
            Placeholder::PATTERN, 
            replacement: fn(array $placeholderParts) => $this->renderPlaceholder(
                $placeholderParts, 
                $dataSetCollection
            )
        );
    }

    protected function renderPlaceholder(array $placeholderParts, DataSetCollection $dataSetCollection) : string
    {
        (object) $placeholder = $this->templateFactory->createPlaceholder(
            _($placeholderParts)->removeFirst()->getValues()->asArray()
        );            

        return $placeholder->render($dataSetCollection);
    }    
}