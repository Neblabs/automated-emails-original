<?php

namespace AutomatedEmails\App\Data\Savers\Abilities;

interface RequestData
{
    public function get(string $key) : mixed;
    public function has(string $key) : bool;
    public function valueIsNotNull(string $key) : bool;
}