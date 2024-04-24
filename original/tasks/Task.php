<?php

namespace AutomatedEmails\Original\Tasks;

use AutomatedEmails\Original\Collections\Collection;
use Exception;

Abstract Class Task
{
    abstract public function run(Collection $taskData);
}