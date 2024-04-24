<?php

namespace AutomatedEmails\Original\Data\Drivers\Abilities;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Data\Query\Parameters;

interface MultipleItemsReadableDriver {
    public function findMany(Parameters $parameters) : Collection;
    public function count(Parameters $parameters) : int;
}