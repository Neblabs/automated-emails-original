<?php

namespace AutomatedEmails\Original\Data\Instructions\Options;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Data\Instructions\Instruction;

Class GetWordPressOptionsAPIInstruction extends Instruction
{
    protected $statement = 'GET';

    public function __construct(string $name, /*mixed*/ $default)
    {
        $this->parameters = new Collection([
            'name' => $name,
            'default' => $default
        ]);
    }
}