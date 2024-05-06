<?php

namespace AutomatedEmails\Original\Cache;

use AutomatedEmails\Original\Cache\Cache;

Class NoCache extends Cache
{
    public function get($key)
    {
        return $this->data->get($key);
    }
    
    public function getIfExists($key) 
    {
        return new AlwaysUseCallableValueResolver;
    } 
}