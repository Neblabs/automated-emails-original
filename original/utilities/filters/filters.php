<?php

namespace AutomatedEmails\Original\Utilities\Filters;

function isInstanceOf(string $type) : callable {
    return fn(mixed $item) => $item instanceof $type;
}