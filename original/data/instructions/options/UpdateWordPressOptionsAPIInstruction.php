<?php

namespace AutomatedEmails\Original\Data\Instructions\Options;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Data\Instructions\Instruction;
use WTEApp\Data\Model\Options\Option;

Class UpdateWordPressOptionsAPIInstruction extends Instruction
{
    protected $statement = 'UPDATE';

    public function __construct(Option $option)
    {
        $this->parameters = new Collection([
            'name' => $option->option_name,
            'value' => $option->option_value,
        ]);
    }

    public function shouldGet() : bool
    {
        return false;
    }
}