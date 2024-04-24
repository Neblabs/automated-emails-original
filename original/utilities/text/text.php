<?php

namespace AutomatedEmails\Original\Utilities\Text;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Environment\Env;

function i(string|StringManager|null $string) : StringManager {
    return $string instanceof StringManager
           ? $string
           : new StringManager($string ?? '');
}