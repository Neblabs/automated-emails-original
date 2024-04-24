<?php

namespace AutomatedEmails\App\Creation\Entities\Abilities;

interface OverloadableEntitiesFactory
{
    public function canCreateEntities(mixed $data) : bool;
    public function canCreateEntity(mixed $data) : bool;
}