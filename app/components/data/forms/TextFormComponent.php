<?php

namespace AutomatedEmails\App\Components\Data\Forms;

use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Domain\Data\DataForm;
use Stringable;

use function AutomatedEmails\Original\Utilities\Text\__;

class TextFormComponent implements Identifiable, Nameable
{
    public function identifier(): string
    {
        return DataForm::TEXT;
    } 

    public function name()/*: Stringable*/
    {
        return __('Text');
    } 
}