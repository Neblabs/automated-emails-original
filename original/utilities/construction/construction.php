<?php

namespace AutomatedEmails\Original\Utilities\Construction;

use AutomatedEmails\Original\Construction\Abilities\Creatable;

function create(Creatable $creatable) : mixed {
    return $creatable->create();
}