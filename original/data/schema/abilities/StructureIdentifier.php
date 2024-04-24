<?php

namespace AutomatedEmails\Original\Data\Schema\Abilities;

use AutomatedEmails\Original\Characters\StringManager;

/**
 * Example:
 * for a database table, it's the database name
 * for a file, it's the file,
 * etc
 */
interface StructureIdentifier
{
    public function get() : StringManager; 
}