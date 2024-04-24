<?php

namespace AutomatedEmails\Original\Data\Drivers\Abilities;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Data\Query\Parameters;

interface SingleItemReadableDriver
{
    public function has(Parameters $parameters) : bool;
    public function findOne(Parameters $parameters) : mixed;
}

//(object) $posts = $postsFinder->withId(87)->find();