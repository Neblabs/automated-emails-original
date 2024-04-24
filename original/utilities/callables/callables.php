<?php

namespace AutomatedEmails\Original\Utilities\Callables;

use AutomatedEmails\Original\Language\CallableBuilder;

function call(object $object) : CallableBuilder
{
    return new CallableBuilder($object);
}
