<?php

namespace AutomatedEmails\App\Domain\Data\Abilities;

use AutomatedEmails\App\Domain\Data\Data;

interface SettableData
{
    public function setData(Data $data) : void;
}