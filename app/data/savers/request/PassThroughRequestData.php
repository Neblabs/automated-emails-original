<?php

namespace AutomatedEmails\App\Data\Savers\Request;

use AutomatedEmails\App\Data\Savers\Abilities\RequestData;
use AutomatedEmails\Original\Collections\Collection;

class PassThroughRequestData implements RequestData
{
    public function __construct(
        protected Collection $data
    ) {}
    
    public function get(string $key) : mixed
    {
        return $this->data->get($key);
    }

    public function has(string $key) : bool
    {
        return $this->data->hasKey($key);
    }

    public function valueIsNotNull(string $key) : bool
    {
        return $this->data->valueIsNotNull($key);
    }
}