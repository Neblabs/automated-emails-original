<?php

namespace AutomatedEmails\Original\Dependency;

interface ContainableDependencies
{
    public function get(string $type) : object;
}