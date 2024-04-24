<?php

namespace AutomatedEmails\Original\Data\Model\Abilities;

use AutomatedEmails\Original\Domain\Entity;

interface FindableById
{
    public function withId(int $id) : Entity;
} 