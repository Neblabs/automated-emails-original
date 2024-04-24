<?php

namespace AutomatedEmails\Original\Events\Registrator\Abilities;

use AutomatedEmails\Original\Events\Subscribers;

interface RegistrableSubscribers
{
    public function register(Subscribers $subscribers);
}