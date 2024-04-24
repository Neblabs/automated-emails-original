<?php

namespace AutomatedEmails\Original\Construction\Abilities;

use AutomatedEmails\Original\Events\Subscriber;

interface SubscriberFactory
{
    public function create(string $ubscriberType) : Subscriber;
}